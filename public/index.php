<?php
    include_once '../app/Config/__conf.php';

    # All Post
    $posts = $db->query('SELECT * FROM posts');
    $posts = $db->q();

    # All Categories
    $categories = $db->query('SELECT * FROM categories');
    $categories = $db->q();

    # Specific Data
    $post = $db->query('SELECT * FROM posts WHERE id = 2');
    $post = $db->q1();
?>
<!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PHP : REST API</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>

    <body class="bg-slate-50">

        <div class="relative w-full max-w-3xl min-h-screen mx-auto p-8 bg-white">

            <div class="relative my-3 text-center">
                <h1 class="text-xl font-semibold text-slate-800">PHP : REST API</h1>
            </div>

            <div class="relative my-2.5 p-6 border-b">
                <div class="relative mb-3">
                    <h2 class="font-semibold text-slate-800">• GET Data</h2>
                </div>
                <form action="./api/reqGET" method="GET">
                    <div class="relative my-[10px]">
                        <select name="id" class="px-3 py-2 text-sm border rounded-xl outline-0 appearance-none">
                            <option>Select Post</option>
                            <?php foreach ($posts as $f_posts) { ?>
                            <option value="<?= $f_posts->id;?>"><?= $f_posts->title;?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="relative my-[10px]">
                        <input type="submit" value="Get" class="py-1 px-5 text-sm text-white bg-slate-600 rounded-lg cursor-pointer hover:bg-slate-800">
                    </div>
                </form>
            </div>

            <div class="relative my-2.5 p-6 border-b">
                <div class="relative mb-3">
                    <h2 class="font-semibold text-slate-800">• POST Data</h2>
                </div>
                <form action="./api/reqPOST" method="POST">
                    <div class="relative my-[10px]">
                        <div>
                            <select name="category" class="px-3 py-2 text-sm border rounded-xl outline-0 appearance-none">
                                <option>Select Category</option>
                                <?php foreach ($categories as $f_category) { ?>
                                <option value="<?= $f_category->id;?>"><?= $f_category->name;?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div>
                            <input type="text" name="title" placeholder="Title" class="block w-full max-w-md my-3 px-3 py-2 border rounded-xl outline-0">
                            <input type="text" name="body" placeholder="Write Post..." class="block w-full max-w-md my-3 px-3 py-2 border rounded-xl outline-0">
                            <input type="text" name="author" placeholder="author" class="block w-full max-w-md my-3 px-3 py-2 border rounded-xl outline-0">
                        </div>
                    </div>
                    <div class="relative my-[10px]">
                        <input type="submit" value="Insert" class="py-1 px-5 text-sm text-white bg-slate-600 rounded-lg cursor-pointer hover:bg-slate-800">
                    </div>
                </form>
            </div>

            <div class="relative my-2.5 p-6 border-b">
                <div class="relative mb-3">
                    <h2 class="font-semibold text-slate-800">• PUT Data</h2>
                </div>
                <form action="./api/reqPUT" method="POST">
                    <div class="relative my-[10px]">
                        <div>
                            <textarea name="title" class="inline-block my-3 px-3 py-2 text-sm text-slate-700 border rounded-xl box-border outline-0"><?= $post->title ;?></textarea>
                            <textarea name="body" class="inline-block my-3 px-3 py-2 text-sm text-slate-700 border rounded-xl box-border outline-0"><?= $post->body ;?></textarea>
                            <textarea name="author" class="inline-block my-3 px-3 py-2 text-sm text-slate-700 border rounded-xl box-border outline-0"><?= $post->author ;?></textarea>
                        </div>
                    </div>
                    <div class="relative my-[10px]">
                        <input type="submit" value="Update" class="py-1 px-5 text-sm text-white bg-slate-600 rounded-lg cursor-pointer hover:bg-slate-800">
                        <input type="hidden" name="id" value="<?= $post->id ;?>">
                    </div>
                </form>
            </div>

            <div class="relative my-2.5 p-6 border-b">
                <div class="relative mb-3">
                    <h2 class="font-semibold text-slate-800">• DELETE Data</h2>
                </div>
                <form action="./api/reqDELETE" method="GET">
                    <div class="relative my-[10px]">
                        <select name="id" class="px-3 py-2 text-sm border rounded-xl outline-0 appearance-none">
                            <option>Select Post</option>
                            <?php foreach ($posts as $f_posts) { ?>
                            <option value="<?= $f_posts->id;?>"><?= $f_posts->title;?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="relative my-[10px]">
                        <input type="submit" value="Delete" class="py-1 px-5 text-sm text-white bg-slate-600 rounded-lg cursor-pointer hover:bg-slate-800">
                    </div>
                </form>
            </div>

        </div>

    </body>

</html>
