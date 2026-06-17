<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $storageDir = storage_path('app/books');
        if (! File::isDirectory($storageDir)) {
            File::makeDirectory($storageDir, 0755, true);
        }

        $sourceDir = public_path('assets/admin');

        $books = [
            [
                'title' => 'Blurred Lines',
                'subtitle' => 'Decoding the Patterns of Cultural Identity',
                'category' => 'Cultural Studies',
                'year' => '2024',
                'cover' => 'book-blurred-lines-odPx23y8.png',
                'description' => 'An incisive exploration of the intricate weave of global traditions, and how identity is shaped, distorted and reborn across borders.',
                'source_file' => 'blurred-lines-2.epub',
                'file_type' => 'epub',
                'price' => 9.99,
                'featured' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'Boosting the Size of Sale',
                'subtitle' => 'An in-depth look at the qualities of a good influencer',
                'category' => 'Business',
                'year' => '2024',
                'cover' => 'book-boosting-sale-B9xmqxqR.png',
                'description' => 'A practical guide to modern persuasion: what makes a voice trusted, a message sticky, and a sale inevitable in the influencer economy.',
                'source_file' => 'boosting-the-size-of-sale-manuscript.pdf',
                'file_type' => 'pdf',
                'price' => 12.99,
                'featured' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'CEOs of TikTok',
                'subtitle' => 'Build New Paradigms of Life and Tech',
                'category' => 'Technology',
                'year' => '2025',
                'cover' => 'book-ceos-tiktok-BTyhDE6Y.png',
                'description' => 'How a new generation of founders is rewriting the rules of leadership, attention, and creative power in a vertical-video world.',
                'source_file' => 'ceos-tiktok.pdf',
                'file_type' => 'pdf',
                'price' => 14.99,
                'featured' => true,
                'sort_order' => 3,
            ],
            [
                'title' => 'IQ: An Overrated Quotient',
                'subtitle' => 'Where creativity meets the technical',
                'category' => 'Essays',
                'year' => '2025',
                'cover' => 'book-iq-quotient-BO-q7Rls.png',
                'description' => 'On the combination of creative and technical thinking: the real foundation of a project, an idea, a life worth building.',
                'source_file' => 'iq-an-overrated-quotient-manuscript (1).pdf',
                'file_type' => 'pdf',
                'price' => 11.99,
                'featured' => true,
                'sort_order' => 4,
            ],
            [
                'title' => 'The Dogged Spirit of Success',
                'subtitle' => 'Persistence, purpose, and the path to lasting achievement',
                'category' => 'Self-Development',
                'year' => '2025',
                'cover' => null,
                'description' => 'A reflection on resilience, discipline, and the mindset required to turn ambition into enduring success.',
                'source_file' => 'the-dogged-spirit-of-success-cover.pdf',
                'file_type' => 'pdf',
                'price' => 10.99,
                'featured' => false,
                'sort_order' => 5,
            ],
        ];

        foreach ($books as $data) {
            $sourceFile = $data['source_file'];
            unset($data['source_file']);

            $storedName = null;
            $sourcePath = $sourceDir.DIRECTORY_SEPARATOR.$sourceFile;

            if (File::exists($sourcePath)) {
                $storedName = date('YmdHis').'_'.preg_replace('/[^a-zA-Z0-9._-]/', '-', $sourceFile);
                File::copy($sourcePath, $storageDir.DIRECTORY_SEPARATOR.$storedName);
            }

            Book::updateOrCreate(
                ['title' => $data['title']],
                array_merge($data, [
                    'excerpt' => $data['description'],
                    'file_path' => $storedName,
                    'status' => true,
                ])
            );
        }

        $permissions = [
            'book-list',
            'book-create',
            'book-edit',
            'book-delete',
        ];

        foreach ($permissions as $name) {
            Permission::firstOrCreate(['name' => $name, 'guard_name' => 'web']);
        }

        $adminRole = Role::where('name', 'Admin')->where('guard_name', 'web')->first()
            ?? Role::where('name', 'admin')->where('guard_name', 'admin')->first()
            ?? Role::where('name', 'admin')->first();

        if ($adminRole) {
            $adminRole->givePermissionTo($permissions);
        }
    }
}
