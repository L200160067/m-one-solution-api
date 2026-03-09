<?php

namespace Database\Seeders;

use App\Models\Alumni;
use App\Models\Category;
use App\Models\Partner;
use App\Models\Post;
use App\Models\Project;
use App\Models\Service;
use App\Models\TeamMember;
use App\Models\Testimonial;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

/**
 * DummyContentSeeder
 *
 * Seeds all content entities with real data mirrored from the
 * M-One Solution frontend static files (src/data/*.ts, Alumni.tsx, Projects.tsx).
 *
 * Run with: php artisan db:seed --class=DummyContentSeeder
 */
class DummyContentSeeder extends Seeder
{
    public function run(): void
    {
        $this->seedCategories();
        $this->seedPosts();
        $this->seedServices();
        $this->seedProjects();
        $this->seedTeamMembers();
        $this->seedAlumni();
        $this->seedTestimonials();
        $this->seedPartners();

        $this->command->info('✅ All dummy content seeded successfully!');
    }

    // ─── Categories ───────────────────────────────────────────────────────────

    private function seedCategories(): void
    {
        $categories = [
            'Web Development',
            'Mobile App',
            'Tips & Trik',
            'Digital Marketing',
            'Design',
            'Security',
            'Cloud',
            'Data',
            'Management',
            'Technology',
        ];

        foreach ($categories as $name) {
            Category::firstOrCreate(
                ['slug' => Str::slug($name)],
                ['name' => $name]
            );
        }

        $this->command->info('  Categories: ' . count($categories) . ' seeded');
    }

    // ─── Blog Posts ───────────────────────────────────────────────────────────

    private function seedPosts(): void
    {
        $adminUser = \App\Models\User::where('email', 'admin@m-one-solution.com')->first();

        $posts = [
            [
                'title'        => 'Pentingnya Website Profesional untuk Bisnis di Era Digital',
                'slug'         => 'pentingnya-website-untuk-bisnis',
                'excerpt'      => 'Di era digital ini, memiliki website bukan lagi pilihan, melainkan keharusan bagi setiap bisnis yang ingin berkembang.',
                'content'      => 'Di era digital ini, memiliki website bukan lagi pilihan, melainkan keharusan bagi setiap bisnis yang ingin berkembang. Website berfungsi sebagai etalase digital yang buka 24/7, memungkinkan calon pelanggan menemukan produk atau layanan Anda kapan saja dan di mana saja. Selain itu, website profesional meningkatkan kredibilitas bisnis Anda di mata konsumen. Dengan desain yang menarik, navigasi yang mudah, dan informasi yang lengkap, website dapat menjadi alat pemasaran yang sangat efektif. M-One Solution siap membantu Anda mewujudkan website impian yang tidak hanya indah dipandang, tetapi juga fungsional dan mampu mendorong pertumbuhan bisnis Anda.',
                'category'     => 'Web Development',
                'published_at' => '2023-10-12 08:00:00',
            ],
            [
                'title'        => 'Tren Pengembangan Aplikasi Mobile di Tahun 2024',
                'slug'         => 'tren-aplikasi-mobile-2024',
                'excerpt'      => 'Dunia pengembangan aplikasi mobile terus berkembang pesat. Mari kita lihat tren apa saja yang akan mendominasi di tahun 2024.',
                'content'      => 'Dunia pengembangan aplikasi mobile terus berkembang pesat. Pertama, integrasi kecerdasan buatan (AI) dan machine learning (ML) akan semakin masif, memberikan pengalaman pengguna yang lebih personal dan cerdas. Kedua, pengembangan aplikasi lintas platform (cross-platform) menggunakan framework seperti React Native dan Flutter akan terus populer karena efisiensi waktu dan biaya. Ketiga, fokus pada keamanan data dan privasi pengguna akan menjadi prioritas utama, seiring dengan meningkatnya kesadaran akan pentingnya perlindungan informasi pribadi.',
                'category'     => 'Mobile App',
                'published_at' => '2023-11-05 09:00:00',
            ],
            [
                'title'        => 'Tips Memilih Software House yang Tepat untuk Proyek Anda',
                'slug'         => 'tips-memilih-software-house',
                'excerpt'      => 'Memilih partner teknologi yang tepat adalah kunci kesuksesan proyek digital Anda.',
                'content'      => 'Memilih partner teknologi yang tepat adalah kunci kesuksesan proyek digital Anda. Pertama, periksa portofolio mereka untuk melihat kualitas dan jenis proyek yang pernah mereka kerjakan. Kedua, pastikan mereka memiliki tim yang kompeten dan berpengalaman dalam teknologi yang relevan dengan kebutuhan Anda. Ketiga, perhatikan cara mereka berkomunikasi dan merespons pertanyaan Anda; komunikasi yang baik sangat penting untuk kelancaran proyek.',
                'category'     => 'Tips & Trik',
                'published_at' => '2023-12-20 10:00:00',
            ],
            [
                'title'        => 'Manfaat SEO untuk Meningkatkan Trafik Website Anda',
                'slug'         => 'manfaat-seo-untuk-website',
                'excerpt'      => 'SEO adalah strategi penting untuk memastikan website Anda mudah ditemukan di mesin pencari seperti Google.',
                'content'      => 'SEO (Search Engine Optimization) adalah strategi penting untuk memastikan website Anda mudah ditemukan di mesin pencari seperti Google. Dengan menerapkan teknik SEO yang tepat, Anda dapat meningkatkan peringkat website Anda di hasil pencarian, yang pada gilirannya akan meningkatkan jumlah pengunjung organik. Hal ini sangat penting karena sebagian besar pengguna internet hanya mengklik hasil pencarian di halaman pertama.',
                'category'     => 'Digital Marketing',
                'published_at' => '2024-01-15 07:00:00',
            ],
            [
                'title'        => 'Mengenal Perbedaan UI dan UX Design',
                'slug'         => 'mengenal-ui-ux-design',
                'excerpt'      => 'UI dan UX seringkali dianggap sama, padahal keduanya memiliki peran yang berbeda dalam pengembangan produk digital.',
                'content'      => 'UI (User Interface) dan UX (User Experience) seringkali dianggap sama, padahal keduanya memiliki peran yang berbeda dalam pengembangan produk digital. UI berfokus pada tampilan visual, seperti warna, tipografi, dan tata letak elemen. Sementara itu, UX berfokus pada pengalaman pengguna secara keseluruhan, termasuk kemudahan penggunaan, efisiensi, dan kepuasan pengguna.',
                'category'     => 'Design',
                'published_at' => '2024-02-02 08:30:00',
            ],
            [
                'title'        => 'Pentingnya Keamanan Siber untuk Melindungi Bisnis Anda',
                'slug'         => 'keamanan-siber-untuk-bisnis',
                'excerpt'      => 'Ancaman keamanan siber semakin meningkat. Pelajari cara melindungi data dan sistem bisnis Anda dari serangan siber.',
                'content'      => 'Ancaman keamanan siber semakin meningkat. Serangan siber dapat menyebabkan kerugian finansial yang besar, kerusakan reputasi, dan hilangnya kepercayaan pelanggan. Oleh karena itu, sangat penting bagi setiap bisnis untuk menerapkan langkah-langkah keamanan siber yang kuat, seperti menggunakan firewall, mengenkripsi data sensitif, dan memberikan pelatihan kesadaran keamanan kepada karyawan.',
                'category'     => 'Security',
                'published_at' => '2024-02-20 09:00:00',
            ],
            [
                'title'        => 'Meningkatkan Efisiensi Bisnis dengan Cloud Computing',
                'slug'         => 'cloud-computing-untuk-efisiensi',
                'excerpt'      => 'Cloud computing menawarkan banyak manfaat bagi bisnis, termasuk fleksibilitas, skalabilitas, dan efisiensi biaya.',
                'content'      => 'Cloud computing menawarkan banyak manfaat bagi bisnis, termasuk fleksibilitas, skalabilitas, dan efisiensi biaya. Dengan menggunakan layanan cloud, Anda tidak perlu lagi berinvestasi dalam infrastruktur TI fisik yang mahal. Anda dapat mengakses data dan aplikasi Anda dari mana saja dan kapan saja, asalkan terhubung ke internet.',
                'category'     => 'Cloud',
                'published_at' => '2024-03-10 08:00:00',
            ],
            [
                'title'        => 'Mengapa Data Analytics Penting untuk Pengambilan Keputusan',
                'slug'         => 'pentingnya-data-analytics',
                'excerpt'      => 'Data analytics dapat memberikan wawasan berharga yang membantu Anda membuat keputusan bisnis yang lebih baik.',
                'content'      => 'Data analytics dapat memberikan wawasan berharga yang membantu Anda membuat keputusan bisnis yang lebih baik. Dengan menganalisis data pelanggan, penjualan, dan operasional, Anda dapat mengidentifikasi tren, pola, dan peluang baru. Hal ini memungkinkan Anda untuk mengoptimalkan strategi pemasaran, meningkatkan efisiensi operasional, dan mengembangkan produk atau layanan baru yang sesuai dengan kebutuhan pelanggan.',
                'category'     => 'Data',
                'published_at' => '2024-03-25 09:30:00',
            ],
            [
                'title'        => 'Tips Membangun Tim Developer yang Solid dan Produktif',
                'slug'         => 'membangun-tim-developer-yang-solid',
                'excerpt'      => 'Tim developer yang solid adalah kunci kesuksesan proyek perangkat lunak.',
                'content'      => 'Tim developer yang solid adalah kunci kesuksesan proyek perangkat lunak. Pertama, rekrut orang-orang dengan keterampilan dan pengalaman yang tepat. Kedua, ciptakan budaya kerja yang positif dan kolaboratif. Ketiga, berikan pelatihan dan pengembangan berkelanjutan kepada anggota tim. Keempat, gunakan alat dan metodologi pengembangan yang tepat, seperti Agile atau Scrum.',
                'category'     => 'Management',
                'published_at' => '2024-04-05 08:00:00',
            ],
            [
                'title'        => 'Masa Depan Kecerdasan Buatan (AI) di Berbagai Industri',
                'slug'         => 'masa-depan-kecerdasan-buatan',
                'excerpt'      => 'Kecerdasan buatan (AI) sedang mengubah cara kita hidup dan bekerja.',
                'content'      => 'Kecerdasan buatan (AI) sedang mengubah cara kita hidup dan bekerja. Di bidang kesehatan, AI dapat digunakan untuk mendiagnosis penyakit, mengembangkan obat baru, dan memberikan perawatan yang lebih personal. Di bidang keuangan, AI dapat digunakan untuk mendeteksi penipuan, mengelola risiko, dan memberikan layanan pelanggan yang lebih baik.',
                'category'     => 'Technology',
                'published_at' => '2024-04-18 10:00:00',
            ],
        ];

        foreach ($posts as $postData) {
            $category = Category::where('slug', Str::slug($postData['category']))->first();

            Post::firstOrCreate(
                ['slug' => $postData['slug']],
                [
                    'title'        => $postData['title'],
                    'excerpt'      => $postData['excerpt'],
                    'content'      => $postData['content'],
                    'category_id'  => $category?->id,
                    'author_id'    => $adminUser?->id,
                    'published_at' => $postData['published_at'],
                ]
            );
        }

        $this->command->info('  Posts: ' . count($posts) . ' seeded');
    }

    // ─── Services ─────────────────────────────────────────────────────────────

    private function seedServices(): void
    {
        $services = [
            [
                'title'             => 'Web Development',
                'slug'              => 'web-development',
                'category'          => 'Development',
                'short_description' => 'Pembuatan website profesional yang responsif, cepat, dan dioptimalkan untuk mesin pencari (SEO).',
                'full_description'  => 'Layanan Web Development kami mencakup pembuatan website dari awal hingga peluncuran. Kami menggunakan teknologi terbaru untuk memastikan website Anda tidak hanya terlihat menarik, tetapi juga memiliki performa tinggi, aman, dan mudah diakses dari berbagai perangkat. Cocok untuk bisnis skala kecil hingga besar yang ingin meningkatkan kehadiran digital mereka.',
                'features'          => ['Desain Responsif (Mobile-Friendly)', 'Optimasi SEO Dasar', 'Integrasi CMS (Content Management System)', 'Keamanan Tingkat Lanjut', 'Performa Cepat & Optimal', 'Dukungan Teknis & Pemeliharaan'],
                'benefits'          => ['Meningkatkan kredibilitas bisnis Anda di dunia digital.', 'Menjangkau lebih banyak calon pelanggan secara online.', 'Memberikan pengalaman pengguna (UX) yang memuaskan.', 'Mudah dikelola dan diperbarui kontennya.'],
                'keywords'          => ['jasa pembuatan website', 'web development', 'bikin web', 'jasa web SEO', 'website responsif', 'jasa website profesional'],
                'order_column'      => 1,
            ],
            [
                'title'             => 'Sistem Informasi Sekolah',
                'slug'              => 'sistem-informasi-sekolah',
                'category'          => 'Sistem Informasi',
                'short_description' => 'Platform digital terpadu untuk mengelola administrasi, akademik, dan komunikasi di lingkungan sekolah.',
                'full_description'  => 'Sistem Informasi Sekolah (SIS) kami dirancang khusus untuk memenuhi kebutuhan institusi pendidikan modern. Platform ini mengintegrasikan berbagai modul mulai dari penerimaan siswa baru, manajemen nilai, absensi, hingga keuangan. Dengan antarmuka yang ramah pengguna, SIS memudahkan guru, staf administrasi, siswa, dan orang tua untuk berinteraksi dan mengakses informasi secara real-time.',
                'features'          => ['Manajemen Data Siswa & Guru', 'Sistem Absensi Digital', 'Portal Nilai & Rapor Online', 'Manajemen Keuangan & Pembayaran SPP', 'Jadwal Pelajaran & Kalender Akademik', 'Portal Komunikasi Orang Tua & Sekolah'],
                'benefits'          => ['Meningkatkan efisiensi administrasi sekolah.', 'Memudahkan pemantauan perkembangan akademik siswa.', 'Transparansi keuangan dan kemudahan pembayaran.', 'Meningkatkan komunikasi antara sekolah dan orang tua.'],
                'keywords'          => ['sistem informasi sekolah', 'aplikasi sekolah', 'software sekolah', 'manajemen sekolah', 'sistem akademik', 'e-learning sekolah'],
                'order_column'      => 2,
            ],
            [
                'title'             => 'Company Profile Website',
                'slug'              => 'company-profile-website',
                'category'          => 'Profil Perusahaan',
                'short_description' => 'Website profil perusahaan yang elegan dan profesional untuk membangun citra merek yang kuat.',
                'full_description'  => 'Website Company Profile adalah wajah digital bisnis Anda. Kami merancang website yang secara efektif mengkomunikasikan nilai, visi, misi, dan layanan perusahaan Anda kepada audiens target. Dengan desain yang elegan dan struktur informasi yang jelas, website ini akan membantu Anda membangun kepercayaan dan kredibilitas di mata klien, mitra, dan investor.',
                'features'          => ['Desain Kustom & Profesional', 'Halaman Tentang Kami, Visi & Misi', 'Galeri Portofolio & Proyek', 'Formulir Kontak & Integrasi Maps', 'Integrasi Media Sosial', 'Optimasi Kecepatan Muat'],
                'benefits'          => ['Membangun citra profesional dan terpercaya.', 'Memudahkan calon klien menemukan informasi tentang perusahaan.', 'Meningkatkan peluang kerja sama bisnis.', 'Menjadi pusat informasi resmi perusahaan di internet.'],
                'keywords'          => ['jasa website company profile', 'website profil perusahaan', 'bikin web perusahaan', 'desain web corporate', 'website bisnis'],
                'order_column'      => 3,
            ],
            [
                'title'             => 'Custom Web Application',
                'slug'              => 'custom-web-application',
                'category'          => 'Aplikasi Khusus',
                'short_description' => 'Pengembangan aplikasi web kustom yang disesuaikan dengan kebutuhan dan proses bisnis spesifik Anda.',
                'full_description'  => 'Setiap bisnis memiliki keunikan dan tantangan tersendiri. Layanan Custom Web Application kami hadir untuk memberikan solusi perangkat lunak yang dirancang khusus untuk mengatasi masalah spesifik dan mengoptimalkan proses bisnis Anda. Mulai dari sistem manajemen inventaris, CRM, ERP, hingga platform e-learning, kami membangun aplikasi yang scalable, aman, dan mudah digunakan.',
                'features'          => ['Analisis Kebutuhan Bisnis Mendalam', 'Arsitektur Perangkat Lunak Scalable', 'Pengembangan Frontend & Backend Kustom', 'Integrasi API Pihak Ketiga', 'Pengujian Keamanan & Kualitas (QA)', 'Pelatihan Pengguna & Dokumentasi'],
                'benefits'          => ['Solusi yang 100% sesuai dengan alur kerja bisnis Anda.', 'Otomatisasi proses manual untuk meningkatkan efisiensi.', 'Keamanan data yang lebih terjamin dengan kontrol penuh.', 'Skalabilitas tinggi untuk mendukung pertumbuhan bisnis di masa depan.'],
                'keywords'          => ['custom web application', 'jasa pembuatan aplikasi web', 'software house', 'bikin aplikasi custom', 'pengembangan sistem informasi', 'aplikasi ERP custom'],
                'order_column'      => 4,
            ],
        ];

        foreach ($services as $data) {
            Service::firstOrCreate(
                ['slug' => $data['slug']],
                $data
            );
        }

        $this->command->info('  Services: ' . count($services) . ' seeded');
    }

    // ─── Projects ─────────────────────────────────────────────────────────────

    private function seedProjects(): void
    {
        $projects = [
            [
                'title'        => 'Website Sekolah',
                'slug'         => 'website-sekolah',
                'category'     => 'Web Development',
                'description'  => 'Platform digital interaktif untuk institusi pendidikan yang mencakup manajemen konten, berita sekolah, dan galeri foto.',
                'client_name'  => 'SMK Muhammadiyah 1 Sukoharjo',
                'is_featured'  => true,
                'order_column' => 1,
            ],
            [
                'title'        => 'Aplikasi Organisasi',
                'slug'         => 'aplikasi-organisasi',
                'category'     => 'Mobile App',
                'description'  => 'Sistem manajemen terpadu untuk efisiensi organisasi, mencakup manajemen anggota, agenda, dan pelaporan.',
                'client_name'  => 'Organisasi Pemuda Sukoharjo',
                'is_featured'  => true,
                'order_column' => 2,
            ],
            [
                'title'        => 'E-Commerce Platform',
                'slug'         => 'ecommerce-platform',
                'category'     => 'Web App',
                'description'  => 'Solusi toko online modern dengan fitur lengkap: manajemen produk, keranjang belanja, pembayaran, dan laporan penjualan.',
                'client_name'  => 'Batik Berkah',
                'is_featured'  => true,
                'order_column' => 3,
            ],
        ];

        foreach ($projects as $data) {
            Project::firstOrCreate(
                ['slug' => $data['slug']],
                $data
            );
        }

        $this->command->info('  Projects: ' . count($projects) . ' seeded');
    }

    // ─── Team Members ─────────────────────────────────────────────────────────

    private function seedTeamMembers(): void
    {
        $team = [
            [
                'name'             => 'Alfarez Syahputra Kuri, S.Kom',
                'role'             => 'Manajer & Founder',
                'social_linkedin'  => 'https://www.linkedin.com/in/alfarez-syahputra-kuri-b53bab231',
                'social_github'    => 'https://github.com/L200160067',
                'social_instagram' => 'https://www.instagram.com/alfarezkuri/',
                'order_column'     => 1,
            ],
            [
                'name'          => 'Siti Rahmawati',
                'role'          => 'Lead Developer',
                'social_github' => '',
                'order_column'  => 2,
            ],
            [
                'name'         => 'Agus Pratama',
                'role'         => 'UI/UX Designer',
                'order_column' => 3,
            ],
            [
                'name'         => 'Dewi Lestari',
                'role'         => 'Project Manager',
                'order_column' => 4,
            ],
        ];

        foreach ($team as $data) {
            TeamMember::firstOrCreate(
                ['name' => $data['name']],
                $data
            );
        }

        $this->command->info('  Team Members: ' . count($team) . ' seeded');
    }

    // ─── Alumni ───────────────────────────────────────────────────────────────

    private function seedAlumni(): void
    {
        $alumni = [
            // Batch 2025
            ['name' => 'Bastian',  'school' => 'SMK Muhammadiyah 1 Sukoharjo', 'batch_period' => 'Batch 2025', 'order_column' => 1],
            ['name' => 'Boneta P', 'school' => 'SMK Muhammadiyah 1 Sukoharjo', 'batch_period' => 'Batch 2025', 'order_column' => 2],
            ['name' => 'Daffa F',  'school' => 'SMK Muhammadiyah 1 Sukoharjo', 'batch_period' => 'Batch 2025', 'order_column' => 3],
            ['name' => 'Denisa R', 'school' => 'SMK Muhammadiyah 1 Sukoharjo', 'batch_period' => 'Batch 2025', 'order_column' => 4],
            ['name' => 'Faza',     'school' => 'SMK Muhammadiyah 1 Sukoharjo', 'batch_period' => 'Batch 2025', 'order_column' => 5],
            ['name' => 'Haikal',   'school' => 'SMK Muhammadiyah 1 Sukoharjo', 'batch_period' => 'Batch 2025', 'order_column' => 6],
            ['name' => 'Iyan',     'school' => 'SMK Muhammadiyah 1 Sukoharjo', 'batch_period' => 'Batch 2025', 'order_column' => 7],
            ['name' => 'Zaydan',   'school' => 'SMK Muhammadiyah 1 Sukoharjo', 'batch_period' => 'Batch 2025', 'order_column' => 8],
            // Batch 2024
            ['name' => 'Abby',   'school' => 'SMK Muhammadiyah 1 Sukoharjo', 'batch_period' => 'Batch 2024', 'order_column' => 1],
            ['name' => 'Afif',   'school' => 'SMK Muhammadiyah 1 Sukoharjo', 'batch_period' => 'Batch 2024', 'order_column' => 2],
            ['name' => 'Arkan',  'school' => 'SMK Muhammadiyah 1 Sukoharjo', 'batch_period' => 'Batch 2024', 'order_column' => 3],
            ['name' => 'Daffa D','school' => 'SMK Muhammadiyah 1 Sukoharjo', 'batch_period' => 'Batch 2024', 'order_column' => 4],
            ['name' => 'Dzakwan','school' => 'SMK Muhammadiyah 1 Sukoharjo', 'batch_period' => 'Batch 2024', 'order_column' => 5],
            ['name' => 'Habib',  'school' => 'SMK Muhammadiyah 1 Sukoharjo', 'batch_period' => 'Batch 2024', 'order_column' => 6],
            ['name' => 'Hanif',  'school' => 'SMK Muhammadiyah 1 Sukoharjo', 'batch_period' => 'Batch 2024', 'order_column' => 7],
            ['name' => 'Shabri', 'school' => 'SMK Muhammadiyah 1 Sukoharjo', 'batch_period' => 'Batch 2024', 'order_column' => 8],
            ['name' => 'Yudha',  'school' => 'SMK Muhammadiyah 1 Sukoharjo', 'batch_period' => 'Batch 2024', 'order_column' => 9],
        ];

        foreach ($alumni as $data) {
            Alumni::firstOrCreate(
                ['name' => $data['name'], 'batch_period' => $data['batch_period']],
                $data
            );
        }

        $this->command->info('  Alumni: ' . count($alumni) . ' seeded (Batch 2024 & 2025)');
    }

    // ─── Testimonials ─────────────────────────────────────────────────────────

    private function seedTestimonials(): void
    {
        $testimonials = [
            [
                'name'      => 'Budi Santoso',
                'role'      => 'Kepala Sekolah',
                'company'   => 'SMA Negeri 1 Jaya',
                'content'   => 'Sistem Informasi Akademik yang dibuat oleh M-One Solution sangat membantu dalam mendigitalisasi proses belajar mengajar di sekolah kami. Antarmukanya intuitif dan mudah digunakan oleh guru maupun siswa.',
                'rating'    => 5,
                'is_active' => true,
            ],
            [
                'name'      => 'Andi Wijaya',
                'role'      => 'Direktur',
                'company'   => 'PT Maju Terus',
                'content'   => 'Pembuatan Company Profile berjalan sangat lancar. Desainnya modern dan sesuai dengan yang kami harapkan. Tim M-One juga responsif terhadap revisi.',
                'rating'    => 5,
                'is_active' => true,
            ],
            [
                'name'      => 'Siti Aminah',
                'role'      => 'Pemilik',
                'company'   => 'Batik Berkah',
                'content'   => 'Aplikasi e-commerce custom yang dibangun sangat fungsional. Kami bisa mengelola stok dan pesanan dengan lebih efisien sekarang. Terima kasih M-One Solution!',
                'rating'    => 5,
                'is_active' => true,
            ],
        ];

        foreach ($testimonials as $data) {
            Testimonial::firstOrCreate(
                ['name' => $data['name'], 'company' => $data['company']],
                $data
            );
        }

        $this->command->info('  Testimonials: ' . count($testimonials) . ' seeded');
    }

    // ─── Partners ─────────────────────────────────────────────────────────────

    private function seedPartners(): void
    {
        $partners = [
            ['name' => 'SMK Muhammadiyah 1 Sukoharjo', 'order_column' => 1],
            ['name' => 'SMA Negeri 1 Jaya',            'order_column' => 2],
            ['name' => 'PT Maju Terus',                 'order_column' => 3],
            ['name' => 'Batik Berkah',                  'order_column' => 4],
        ];

        foreach ($partners as $data) {
            Partner::firstOrCreate(
                ['name' => $data['name']],
                $data
            );
        }

        $this->command->info('  Partners: ' . count($partners) . ' seeded');
    }
}
