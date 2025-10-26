<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title><?= htmlspecialchars($blog['title'], ENT_QUOTES, 'UTF-8') ?> - BLOG OS</title>
    <link rel="icon" type="image/x-icon" href="/php-project/assets/images/icon.png">
    <link rel="stylesheet" href="/php-project/assets/css/style.css">
</head>

<body class="bg-base-200 min-h-screen">
    <div class="container mx-auto px-4 py-8 max-w-4xl">
        <!-- Header -->
        <div class="navbar bg-base-100 shadow-lg rounded-box mb-8">
            <div class="flex-1">
                <div class="flex items-center gap-3">
                    <img src="/php-project/assets/images/icon.png" alt="Logo" class="h-10 w-10">
                    <h1 class="text-2xl font-bold">
                        <a href="/php-project/" class="text-primary hover:text-primary/80">BLOG OS</a>
                    </h1>
                </div>
            </div>
            <div class="flex-none gap-2">
                <a href="/php-project/create" class="btn btn-primary btn-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Create New Post
                </a>
                <a href="/php-project/" class="btn btn-outline btn-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to List
                </a>
            </div>
        </div>

        <main>
            <article class="card bg-base-100 shadow-lg">
                <div class="card-body">
                    <!-- Post Header -->
                    <header class="mb-8 pb-6 border-b border-base-300">
                        <h1 class="text-4xl font-bold text-base-content mb-4">
                            <?= htmlspecialchars($blog['title'], ENT_QUOTES, 'UTF-8') ?>
                        </h1>
                        <div class="flex flex-wrap items-center gap-4 text-sm text-base-content/60">
                            <div class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                <span
                                    class="font-medium"><?= htmlspecialchars($blog['author'], ENT_QUOTES, 'UTF-8') ?></span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span><?= date('M j, Y \a\t g:i A', strtotime($blog['created_at'])) ?></span>
                            </div>
                            <?php if ($blog['updated_at'] !== $blog['created_at']): ?>
                                <div class="flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    <span>Updated <?= date('M j, Y \a\t g:i A', strtotime($blog['updated_at'])) ?></span>
                                </div>
                            <?php endif; ?>
                        </div>
                    </header>

                    <!-- Featured Image -->
                    <?php if (!empty($blog['image_data'])): ?>
                        <div class="mb-8">
                            <img src="/php-project/image/<?= htmlspecialchars($blog['id']) ?>"
                                alt="<?= htmlspecialchars($blog['title'], ENT_QUOTES, 'UTF-8') ?>"
                                class="w-full h-96 object-cover rounded-lg shadow-lg">
                        </div>
                    <?php endif; ?>

                    <!-- Post Content -->
                    <div class="prose prose-lg max-w-none mb-8">
                        <div class="text-base-content leading-relaxed">
                            <?= nl2br(htmlspecialchars($blog['content'], ENT_QUOTES, 'UTF-8')) ?>
                        </div>
                    </div>

                    <!-- Post Actions -->
                    <div class="card-actions justify-end pt-6 border-t border-base-300">
                        <a href="/php-project/edit/<?= htmlspecialchars($blog['id']) ?>" class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            Edit Post
                        </a>
                        <form method="POST" action="/php-project/delete/<?= htmlspecialchars($blog['id']) ?>"
                            class="inline">
                            <button type="submit" class="btn btn-error"
                                onclick="return confirm('Are you sure you want to delete this post? This action cannot be undone.')">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                Delete Post
                            </button>
                        </form>
                    </div>
                </div>
            </article>
        </main>
    </div>
</body>

</html>