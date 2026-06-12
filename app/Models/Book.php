<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Book extends Model
{
    protected $guarded = [];

    protected $casts = [
        'featured' => 'boolean',
        'status' => 'boolean',
        'price' => 'decimal:2',
    ];

    protected static function booted(): void
    {
        static::creating(function (Book $book) {
            if (empty($book->slug)) {
                $book->slug = static::uniqueSlug($book->title);
            }
        });

        static::updating(function (Book $book) {
            if ($book->isDirty('title') && ! $book->isDirty('slug')) {
                $book->slug = static::uniqueSlug($book->title, $book->id);
            }
        });
    }

    public static function uniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $slug = Str::slug($title);
        $base = $slug;
        $counter = 1;

        while (static::query()
            ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
            ->where('slug', $slug)
            ->exists()) {
            $slug = $base.'-'.$counter;
            $counter++;
        }

        return $slug;
    }

    public function orders(): HasMany
    {
        return $this->hasMany(BookOrder::class);
    }

    public function coverUrl(): string
    {
        if ($this->cover) {
            return asset('assets/website/images/'.$this->cover);
        }

        return asset('assets/website/images/book-placeholder.png');
    }

    public function formattedPrice(): string
    {
        return '$'.number_format((float) $this->price, 2);
    }

    public function resolveFilePath(): ?string
    {
        if (! $this->file_path) {
            return null;
        }

        $bookDir = storage_path('app/books');
        $candidates = [
            $bookDir.DIRECTORY_SEPARATOR.$this->file_path,
            $bookDir.DIRECTORY_SEPARATOR.basename($this->file_path),
        ];

        foreach ($candidates as $path) {
            if (is_file($path)) {
                return $path;
            }
        }

        if (! is_dir($bookDir)) {
            @mkdir($bookDir, 0755, true);
        }

        $sourceDir = public_path('assets/admin');
        if (! is_dir($sourceDir)) {
            return null;
        }

        $slugWords = array_filter(explode('-', $this->slug), fn ($w) => strlen($w) > 2);

        foreach (scandir($sourceDir) ?: [] as $file) {
            if (! preg_match('/\.(pdf|epub)$/i', $file)) {
                continue;
            }

            $lower = strtolower($file);
            $matches = 0;

            foreach ($slugWords as $word) {
                if (str_contains($lower, $word)) {
                    $matches++;
                }
            }

            if ($matches >= min(2, count($slugWords))) {
                $dest = $bookDir.DIRECTORY_SEPARATOR.$this->file_path;

                if (! is_file($dest)) {
                    @copy($sourceDir.DIRECTORY_SEPARATOR.$file, $dest);
                }

                if (is_file($dest)) {
                    return $dest;
                }
            }
        }

        return null;
    }

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }
}
