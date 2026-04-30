<?php

namespace App\Controllers;

class CaptchaController extends \CodeIgniter\Controller
{
    // ── Public endpoints ───────────────────────────────────────────────────

    /**
     * @deprecated CSS-based widget no longer calls these endpoints.
     */
    public function slideBackground(string $token): void
    {
        $this->abort();
    }

    /**
     * @deprecated CSS-based widget no longer calls these endpoints.
     */
    public function slidePiece(string $token): void
    {
        $this->abort();
    }

    public function slideRefresh(): void
    {
        $old = (string)($this->request->getGet('old') ?? '');
        if (preg_match('/^[a-f0-9]{32}$/', $old)) {
            session()->remove('slide_captcha_' . $old);
        }
        $result = self::makeToken();
        header('Content-Type: application/json');
        echo json_encode([
            'token'   => $result['token'],
            'gap_y'   => $result['gap_y'],
            'gap_x'   => $result['gap_x'],
            'img_url' => $result['img_url'],
        ]);
    }

    // ── Static helpers called from Landing / LandingEn controllers ─────────

    /**
     * Generate a new captcha challenge.
     * Returns ['token' => string, 'gap_y' => int]
     */
    public static function makeToken(): array
    {
        $gapX = rand(80, 220);
        $gapY = rand(20, 80);

        $candidates = [
            'fishdeep' => ROOTPATH . 'assets/image/fishdeep.png',
            'gurita'   => ROOTPATH . 'assets/image/gurita.png',
            'bxseahd'  => ROOTPATH . 'assets/image/bxseahd.png',
        ];
        $available = array_filter($candidates, 'file_exists');
        if (empty($available)) {
            $available = $candidates;
        }

        $imgKey = array_rand($available);
        $token  = bin2hex(random_bytes(16));
        session()->set('slide_captcha_' . $token, [
            'x'   => $gapX,
            'y'   => $gapY,
            'img' => $available[$imgKey],
            'exp' => time() + 300,
        ]);

        return [
            'token'   => $token,
            'gap_y'   => $gapY,
            'gap_x'   => $gapX,
            'img_url' => base_url('assets/image/' . $imgKey . '.png'),
        ];
    }

    /**
     * Verify slider position against stored session.
     * Removes session key after check (prevents replay).
     */
    public static function verify(string $token, int $pos): bool
    {
        if (!preg_match('/^[a-f0-9]{32}$/', $token)) return false;
        $data = session()->get('slide_captcha_' . $token);
        session()->remove('slide_captcha_' . $token);
        if (!$data || time() > ($data['exp'] ?? 0)) return false;
        return abs($pos - $data['x']) <= 8;
    }

    // ── Private helpers ───────────────────────────────────────────────────

    private function abort(): void
    {
        http_response_code(404);
        exit;
    }
}
