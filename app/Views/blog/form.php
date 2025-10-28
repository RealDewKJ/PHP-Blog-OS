<?php
$isEdit = !empty($data['id']);
$pageTitle = $isEdit ? 'Edit Post' : 'Create New Post';

$successMessage = $data['success_message'] ?? null;
$isSuccess = $data['success'] ?? false;
?>
<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title><?= $pageTitle ?> - BLOG OS</title>
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
            <div class="flex-none<?= $isEdit ? ' gap-2' : '' ?>">
                <?php if ($isEdit): ?>
                    <a href="/php-project/show/<?= htmlspecialchars($data['id']) ?>" class="btn btn-outline btn-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        View Post
                    </a>
                <?php endif; ?>
                <a href="/php-project/" class="btn btn-outline<?= !$isEdit ? '' : ' btn-sm' ?>">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-<?= $isEdit ? '4' : '5' ?> w-<?= $isEdit ? '4' : '5' ?>" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to List
                </a>
            </div>
        </div>
        <!-- End Header -->

        <!-- Main Content -->
        <main>
            <div class="card bg-base-100 shadow-lg">
                <div class="card-body">
                    <h2 class="card-title text-3xl mb-6"><?= $pageTitle ?></h2>

                    <!-- Errors -->
                    <?php if (!empty($errors)): ?>
                        <div class="alert alert-error mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div>
                                <h3 class="font-bold">Please fix the following errors:</h3>
                                <ul class="list-disc list-inside">
                                    <?php foreach ($errors as $error): ?>
                                        <li><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    <?php endif; ?>
                    <!-- End Errors -->

                    <!-- Form -->
                    <form method="POST" enctype="multipart/form-data" class="space-y-6">
                        <!-- Title -->
                        <div class="form-control">
                            <label class="label" for="title">
                                <span class="label-text font-semibold">Title</span>
                            </label>
                            <input type="text" id="title" name="title"
                                value="<?= htmlspecialchars($data['title'], ENT_QUOTES, 'UTF-8') ?>"
                                class="input input-bordered w-full" placeholder="Enter post title" required>
                        </div>
                        <!-- End Title -->

                        <!-- Author -->
                        <div class="form-control">
                            <label class="label" for="author">
                                <span class="label-text font-semibold">Author</span>
                            </label>
                            <input type="text" id="author" name="author"
                                value="<?= htmlspecialchars($data['author'], ENT_QUOTES, 'UTF-8') ?>"
                                class="input input-bordered w-full" placeholder="Enter author name" required>
                        </div>
                        <!-- End Author -->

                        <!-- Featured Image -->
                        <div class="form-control">
                            <label class="label" for="image">
                                <span class="label-text font-semibold">Featured Image</span>
                            </label>

                            <?php if ($isEdit && !empty($data['image_data'])): ?>
                                <div class="mb-4">
                                    <img src="/php-project/image/<?= htmlspecialchars($data['id']) ?>" alt="Current image"
                                        class="w-32 h-32 object-cover rounded-lg border">
                                    <div class="text-sm text-base-content/60 mt-2">Current image</div>
                                </div>
                            <?php endif; ?>

                            <fieldset class="fieldset w-full">
                                <legend class="fieldset-legend">Pick a file</legend>
                                <input type="file" id="image" name="image" class="file-input file-input-bordered w-full"
                                    accept="image/*">
                                <div class="label">
                                    <span class="label-text-alt">Supported formats: JPEG, PNG, GIF, WebP (Max size:
                                        5MB)</span>
                                </div>
                            </fieldset>
                        </div>
                        <!-- End Featured Image -->

                        <!-- Content -->
                        <div class="form-control">
                            <label class="label" for="content">
                                <span class="label-text font-semibold">Content</span>
                            </label>
                            <textarea id="content" name="content" rows="10"
                                class="textarea textarea-bordered w-full h-64"
                                placeholder="Write your post content here..."
                                required><?= htmlspecialchars($data['content'], ENT_QUOTES, 'UTF-8') ?></textarea>
                        </div>
                        <!-- End Content -->

                        <!-- Form Actions -->
                        <div class="card-actions justify-end">
                            <?php if ($isEdit): ?>
                                <a href="/php-project/show/<?= htmlspecialchars($data['id']) ?>"
                                    class="btn btn-outline">Cancel</a>
                                <button type="submit" class="btn btn-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    Update Post
                                </button>
                            <?php else: ?>
                                <a href="/php-project/" class="btn btn-outline">Cancel</a>
                                <button type="submit" class="btn btn-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v16m8-8H4" />
                                    </svg>
                                    Create Post
                                </button>
                            <?php endif; ?>
                        </div>
                        <!-- End Form Actions -->
                    </form>
                    <!-- End Form -->
                </div>
            </div>
        </main>
        <!-- End Main Content -->
    </div>

    <!-- Loading Modal -->
    <dialog id="loadingModal" class="modal">
        <div class="modal-box text-center">
            <div class="loading mx-auto mb-4"></div>
            <h3 class="font-bold text-lg mb-2">Saving...</h3>
            <p class="text-sm text-base-content/60">Please wait while we save your post.</p>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>
    <!-- End Loading Modal -->

    <!-- Success Modal -->
    <?php if ($isSuccess && $successMessage): ?>
        <dialog id="successModal" class="modal" open>
            <div class="modal-box text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-12 w-12 mx-auto mb-4"
                    style="color: var(--fallback-su,oklch(var(--su)/1));" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h3 class="font-bold text-lg mb-2" style="color: var(--fallback-su,oklch(var(--su)/1));">Success!</h3>
                <p class="text-sm mb-6"><?= htmlspecialchars($successMessage, ENT_QUOTES, 'UTF-8') ?></p>
                <div class="modal-action justify-center">
                    <button class="btn btn-primary" onclick="redirectToIndex()">Go to Blog List</button>
                </div>
            </div>
            <form method="dialog" class="modal-backdrop">
                <button>close</button>
            </form>
        </dialog>
    <?php endif; ?>
    <!-- End Success Modal -->

    <!-- Scripts -->
    <script>
        document.querySelector('form').addEventListener('submit', function () {
            document.getElementById('loadingModal').showModal();
        });

        function redirectToIndex() {
            window.location.href = '/php-project/';
        }

        <?php if ($isSuccess && $successMessage): ?>
            setTimeout(function () {
                redirectToIndex();
            }, 3000);
        <?php endif; ?>
    </script>
    <!-- End Scripts -->
</body>

</html>