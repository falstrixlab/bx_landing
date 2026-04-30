<?php

namespace App\Controllers;

class CaptchaController extends \CodeIgniter\Controller
{
    private const CANVAS_W = 310;
    private const CANVAS_H = 155;
    private const PIECE_W  = 55;
    private const PIECE_H  = 55;
    private const TAB_R    = 10;
    private const TOTAL_W  = 65; // PIECE_W + TAB_R

    // ── Public endpoints ───────────────────────────────────────────────────

    public function slideBackground(string $token): void
    {
        $data = $this->getSessionData($token);
        if (!$data) { $this->abort(); return; }

        $img = $this->loadAndResize($data['img']);
        $this->drawHole($img, $data['x'], $data['y']);

        header('Content-Type: image/png');
        header('Cache-Control: no-store, no-cache, must-revalidate');
        header('Pragma: no-cache');
        imagepng($img);
        imagedestroy($img);
    }

    public function slidePiece(string $token): void
    {
        $data = $this->getSessionData($token);
        if (!$data) { $this->abort(); return; }

        $full  = $this->loadAndResize($data['img']);
        $piece = imagecreatetruecolor(self::TOTAL_W, self::PIECE_H);
        imagesavealpha($piece, true);
        imagealphablending($piece, false);
        $tp = imagecolorallocatealpha($piece, 0, 0, 0, 127);
        imagefill($piece, 0, 0, $tp);

        $gapX = $data['x'];
        $gapY = $data['y'];

        for ($py = 0; $py < self::PIECE_H; $py++) {
            for ($px = 0; $px < self::TOTAL_W; $px++) {
                if (!$this->inside($px, $py)) continue;
                $sx = $gapX + $px;
                $sy = $gapY + $py;
                if ($sx >= 0 && $sx < self::CANVAS_W && $sy >= 0 && $sy < self::CANVAS_H) {
                    imagesetpixel($piece, $px, $py, imagecolorat($full, $sx, $sy));
                }
            }
        }
        imagedestroy($full);

        $this->drawBorder($piece, 0, 0, self::TOTAL_W, self::PIECE_H);

        header('Content-Type: image/png');
        header('Cache-Control: no-store, no-cache, must-revalidate');
        header('Pragma: no-cache');
        imagepng($piece);
        imagedestroy($piece);
    }

    public function slideRefresh(): void
    {
        $old = (string)($this->request->getGet('old') ?? '');
        if (preg_match('/^[a-f0-9]{32}$/', $old)) {
            session()->remove('slide_captcha_' . $old);
        }
        $result = self::makeToken();
        header('Content-Type: application/json');
        echo json_encode(['token' => $result['token'], 'gap_y' => $result['gap_y']]);
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
            ROOTPATH . 'assets/image/fishdeep.png',
            ROOTPATH . 'assets/image/gurita.png',
            ROOTPATH . 'assets/image/bxseahd.png',
        ];
        $images = array_values(array_filter($candidates, 'file_exists'));
        if (empty($images)) {
            $images = $candidates;
        }

        $token = bin2hex(random_bytes(16));
        session()->set('slide_captcha_' . $token, [
            'x'   => $gapX,
            'y'   => $gapY,
            'img' => $images[array_rand($images)],
            'exp' => time() + 300,
        ]);

        return ['token' => $token, 'gap_y' => $gapY];
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

    private function getSessionData(string $token): ?array
    {
        if (!preg_match('/^[a-f0-9]{32}$/', $token)) return null;
        $data = session()->get('slide_captcha_' . $token);
        if (!$data || time() > ($data['exp'] ?? 0)) return null;
        return $data;
    }

    private function loadAndResize(string $path): \GdImage
    {
        if (file_exists($path)) {
            $info = @getimagesize($path);
            if ($info) {
                $src = match ((int)$info[2]) {
                    IMAGETYPE_PNG  => @imagecreatefrompng($path),
                    IMAGETYPE_JPEG => @imagecreatefromjpeg($path),
                    IMAGETYPE_GIF  => @imagecreatefromgif($path),
                    default        => false,
                };
                if ($src) {
                    $canvas = imagecreatetruecolor(self::CANVAS_W, self::CANVAS_H);
                    imagecopyresampled(
                        $canvas, $src, 0, 0, 0, 0,
                        self::CANVAS_W, self::CANVAS_H,
                        imagesx($src), imagesy($src)
                    );
                    imagedestroy($src);
                    return $canvas;
                }
            }
        }
        return $this->fallbackImage();
    }

    private function fallbackImage(): \GdImage
    {
        $img = imagecreatetruecolor(self::CANVAS_W, self::CANVAS_H);
        for ($y = 0; $y < self::CANVAS_H; $y++) {
            $c = imagecolorallocate($img,
                (int)(18 + $y * 0.15),
                (int)(38 + $y * 0.40),
                (int)(95 + $y * 0.35)
            );
            imageline($img, 0, $y, self::CANVAS_W - 1, $y, $c);
        }
        return $img;
    }

    private function drawHole(\GdImage $img, int $x, int $y): void
    {
        for ($py = 0; $py < self::PIECE_H; $py++) {
            for ($px = 0; $px < self::TOTAL_W; $px++) {
                if (!$this->inside($px, $py)) continue;
                $ix = $x + $px;
                $iy = $y + $py;
                if ($ix < 0 || $ix >= self::CANVAS_W || $iy < 0 || $iy >= self::CANVAS_H) continue;
                $orig = imagecolorat($img, $ix, $iy);
                $r    = (int)(($orig >> 16 & 0xFF) * 0.25);
                $g    = (int)(($orig >>  8 & 0xFF) * 0.25);
                $b    = (int)(($orig        & 0xFF) * 0.25);
                imagesetpixel($img, $ix, $iy, ($r << 16) | ($g << 8) | $b);
            }
        }
        $this->drawBorder($img, $x, $y, self::CANVAS_W, self::CANVAS_H);
    }

    private function drawBorder(\GdImage $img, int $offX, int $offY, int $imgW, int $imgH, int $color = 0xFFFFFF): void
    {
        for ($py = 0; $py < self::PIECE_H; $py++) {
            for ($px = 0; $px < self::TOTAL_W; $px++) {
                if (!$this->inside($px, $py) || !$this->isEdge($px, $py)) continue;
                $ix = $offX + $px;
                $iy = $offY + $py;
                if ($ix >= 0 && $ix < $imgW && $iy >= 0 && $iy < $imgH) {
                    imagesetpixel($img, $ix, $iy, $color);
                }
            }
        }
    }

    private function inside(int $px, int $py): bool
    {
        $inBody = $px >= 0 && $px < self::PIECE_W && $py >= 0 && $py < self::PIECE_H;
        $dx     = $px - self::PIECE_W;
        $dy     = $py - (int)(self::PIECE_H / 2);
        $inTab  = ($dx * $dx + $dy * $dy) <= (self::TAB_R * self::TAB_R);
        return $inBody || $inTab;
    }

    private function isEdge(int $px, int $py): bool
    {
        return $this->inside($px, $py) && (
            !$this->inside($px - 1, $py) ||
            !$this->inside($px + 1, $py) ||
            !$this->inside($px, $py - 1) ||
            !$this->inside($px, $py + 1)
        );
    }

    private function abort(): void
    {
        http_response_code(404);
        exit;
    }
}
