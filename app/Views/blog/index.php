<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Blog Posts</title>
    <link rel="icon" type="image/x-icon" href="/php-project/assets/images/icon.png">
    <link rel="stylesheet" href="/php-project/assets/css/style.css">
</head>

<body class="bg-base-200 min-h-screen">
    <div class="container mx-auto px-4 py-8 max-w-7xl">
        <!-- Header -->
        <div class="navbar bg-base-100 shadow-lg rounded-box mb-8">
            <div class="flex-1">
                <div class="flex items-center gap-3">
                    <img src="/php-project/assets/images/icon.png" alt="Logo" class="h-10 w-10">
                    <h1 class="text-2xl font-bold text-primary">BLOG OS</h1>
                </div>
            </div>
            <div class="flex-none">
                <a href="/php-project/create" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Create New Post
                </a>
            </div>
        </div>


        <main>
            <?php if (empty($blogs)): ?>
                <div class="hero min-h-96 bg-base-100 rounded-box shadow-lg">
                    <div class="hero-content text-center">
                        <div class="max-w-md">
                            <h2 class="text-3xl font-bold text-base-content mb-4">No Posts Yet</h2>
                            <p class="text-base-content/70 mb-6">Start your blogging journey by creating your first post!
                            </p>
                            <a href="/php-project/create" class="btn btn-primary btn-lg">Create Your First Post</a>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php foreach ($blogs as $blog): ?>
                        <div class="card bg-base-100 shadow-lg hover:shadow-xl transition-shadow duration-300">
                            <?php if (!empty($blog['image_data'])): ?>
                                <figure class="px-6 pt-6">
                                    <img src="/php-project/image/<?= htmlspecialchars($blog['id']) ?>"
                                        alt="<?= htmlspecialchars($blog['title'], ENT_QUOTES, 'UTF-8') ?>"
                                        class="rounded-xl w-full h-48 object-cover">
                                </figure>
                            <?php endif; ?>
                            <div class="card-body">
                                <h2 class="card-title text-lg">
                                    <a href="/php-project/show/<?= htmlspecialchars($blog['id']) ?>" class="link link-hover">
                                        <?= htmlspecialchars($blog['title'], ENT_QUOTES, 'UTF-8') ?>
                                    </a>
                                </h2>
                                <div class="text-sm text-base-content/60 mb-3">
                                    <span
                                        class="badge badge-outline badge-sm"><?= htmlspecialchars($blog['author'], ENT_QUOTES, 'UTF-8') ?></span>
                                    <span class="mx-2">•</span>
                                    <span><?= date('M j, Y', strtotime($blog['created_at'])) ?></span>
                                </div>
                                <p class="text-base-content/80 text-sm leading-relaxed">
                                    <?= htmlspecialchars(mb_substr($blog['content'], 0, 120, 'UTF-8')) ?>
                                    <?= mb_strlen($blog['content'], 'UTF-8') > 120 ? '...' : '' ?>
                                </p>
                                <div class="card-actions justify-end mt-4">
                                    <a href="/php-project/show/<?= htmlspecialchars($blog['id']) ?>"
                                        class="btn btn-sm btn-outline">Read More</a>
                                    <a href="/php-project/edit/<?= htmlspecialchars($blog['id']) ?>"
                                        class="btn btn-sm btn-info">Edit</a>
                                    <button type="button" class="btn btn-sm btn-error"
                                        onclick="deleteModal<?= $blog['id'] ?>.showModal()">Delete</button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </main>
    </div>

    <?php foreach ($blogs as $blog): ?>
        <dialog id="deleteModal<?= $blog['id'] ?>" class="modal">
            <div class="modal-box">
                <h3 class="font-bold text-lg text-error mb-4">Delete Post</h3>
                <p class="py-4">Are you sure you want to delete
                    "<strong><?= htmlspecialchars($blog['title'], ENT_QUOTES, 'UTF-8') ?></strong>"?</p>
                <p class="text-sm text-base-content/60 mb-6">This action cannot be undone.</p>
                <div class="modal-action">
                    <form method="dialog">
                        <button class="btn btn-outline">Cancel</button>
                    </form>
                    <form method="POST" action="/php-project/delete/<?= htmlspecialchars($blog['id']) ?>" class="inline">
                        <button type="submit" class="btn btn-error">Delete</button>
                    </form>
                </div>
            </div>
            <form method="dialog" class="modal-backdrop">
                <button>close</button>
            </form>
        </dialog>
    <?php endforeach; ?>
</body>

</html>