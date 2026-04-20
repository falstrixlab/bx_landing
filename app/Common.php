<?php

/**
 * The goal of this file is to allow developers a location
 * where they can overwrite core procedural functions and
 * replace them with their own. This file is loaded during
 * the bootstrap process and is called during the framework's
 * execution.
 *
 * This can be looked at as a `master helper` file that is
 * loaded early on, and may also contain additional functions
 * that you'd like to use throughout your entire application
 *
 * @see: https://codeigniter.com/user_guide/extending/common.html
 */

if (! function_exists('bxsea_asset_url')) {
	function bxsea_asset_url(string $uploadSubdir, ?string $filename, string $fallback = '', string $landingSubdir = 'image'): string
	{
		$filename = trim((string) $filename);

		if ($filename !== '') {
			$uploadPath = ROOTPATH . 'assets/upload/' . trim($uploadSubdir, '/') . '/' . $filename;
			if (is_file($uploadPath)) {
				return base_url('assets/upload/' . trim($uploadSubdir, '/') . '/' . $filename);
			}

			$landingPath = ROOTPATH . 'assets/landing/' . trim($landingSubdir, '/') . '/' . $filename;
			if (is_file($landingPath)) {
				return base_url('assets/landing/' . trim($landingSubdir, '/') . '/' . $filename);
			}
		}

		if ($fallback === '') {
			return '';
		}

		if (preg_match('#^https?://#i', $fallback)) {
			return $fallback;
		}

		return base_url(ltrim($fallback, '/'));
	}
}

if (! function_exists('bxsea_plain_text')) {
	function bxsea_plain_text(?string $value): string
	{
		if ($value === null) {
			return '';
		}

		$decoded = html_entity_decode($value, ENT_QUOTES | ENT_HTML5, 'UTF-8');
		$decoded = preg_replace('/\?{3,}/', ' ', $decoded ?? '');
		$decoded = preg_replace('#<(br\s*/?|/p|/div|/li|/ul|/ol|/h[1-6]|/blockquote)>#i', ' ', $decoded ?? '');
		$plain = strip_tags($decoded);
		$plain = preg_replace('/\s+/u', ' ', $plain ?? '');

		return trim((string) $plain);
	}
}

if (! function_exists('bxsea_render_html')) {
	function bxsea_render_html(?string $value, string $allowedTags = '<p><br><strong><em><ul><ol><li><a><h1><h2><h3><h4><h5><h6><blockquote>'): string
	{
		if ($value === null) {
			return '';
		}

		$decoded = html_entity_decode($value, ENT_QUOTES | ENT_HTML5, 'UTF-8');
		$normalized = preg_replace('/\x{00A0}+/u', ' ', $decoded ?? '');
		$clean = strip_tags($normalized ?? '', $allowedTags);

		return trim((string) $clean);
	}
}

if (! function_exists('bxsea_social_icon_fallback')) {
	function bxsea_social_icon_fallback(?string $name, string $context = 'header'): string
	{
		$name = strtolower(trim((string) $name));

		$map = [
			'header' => [
				'instagram' => 'assets/landing/image/Group 1171275393.svg',
				'facebook' => 'assets/landing/image/Group 1171275394.svg',
				'tiktok' => 'assets/landing/image/tiktok.svg',
			],
			'footer' => [
				'instagram' => 'assets/landing/image/Group 1171275076.png',
				'facebook' => 'assets/landing/image/Group 117.png',
				'tiktok' => 'assets/landing/image/Group 1171275074.png',
			],
		];

		return $map[$context][$name] ?? 'assets/landing/image/Group 1171275393.svg';
	}
}

if (! function_exists('bxsea_design_asset_records')) {
	function bxsea_design_asset_records(bool $refresh = false): array
	{
		static $records = null;

		if ($refresh || $records === null) {
			$records = [];

			try {
				$db = \Config\Database::connect();
				if (! $db->tableExists('tbl_designasset')) {
					return $records;
				}

				$query = $db->table('tbl_designasset')
					->where('designasset_status', 1)
					->orderBy('designasset_group', 'ASC')
					->orderBy('designasset_sort', 'ASC')
					->get();

				if ($query === false) {
					return $records;
				}

				$rows = $query->getResultArray();

				foreach ($rows as $row) {
					$records[$row['designasset_group']][$row['designasset_key']] = $row;
				}
			} catch (\Throwable $e) {
				log_message('error', $e->getMessage());
				return [];
			}
		}

		return $records;
	}
}

if (! function_exists('bxsea_design_asset')) {
	function bxsea_design_asset(string $group, string $key, string $default = ''): string
	{
		$records = bxsea_design_asset_records();
		$row = $records[$group][$key] ?? null;

		if ($row) {
			$filename = trim((string) ($row['designasset_file'] ?? ''));
			$directory = trim((string) ($row['designasset_directory'] ?? 'image'), '/');
			$source = strtolower(trim((string) ($row['designasset_source'] ?? 'redesign')));

			if ($filename !== '') {
				if ($source === 'upload') {
					$uploadPath = ROOTPATH . 'assets/upload/designasset/' . $filename;
					if (is_file($uploadPath)) {
						return base_url('assets/upload/designasset/' . $filename);
					}
				}

				$landingPath = ROOTPATH . 'assets/landing/' . $directory . '/' . $filename;
				if (is_file($landingPath)) {
					return base_url('assets/landing/' . $directory . '/' . $filename);
				}
			}
		}

		if ($default === '') {
			return '';
		}

		return base_url(ltrim($default, '/'));
	}
}

if (! function_exists('bxsea_design_asset_meta')) {
	function bxsea_design_asset_meta(string $group, string $key): array
	{
		$records = bxsea_design_asset_records();
		return $records[$group][$key] ?? [];
	}
}
