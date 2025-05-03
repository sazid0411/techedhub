    <?php

    require "../component/db_conn.php";


    $class_id = 1; // Class Six

    $chapter_query = $conn->prepare("SELECT id, title FROM chapters WHERE class_id=?");
    $chapter_query->bind_param("i", $class_id);
    $chapter_query->execute();
    $chapters = $chapter_query->get_result();
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <?php require  "../component/all_link.php" ?>

    <head>
        <title>Class Six || Courses</title>
    </head>

    <body class="bg-[#EFEBF5]">
        <?php require "../component/head.php" ?>


        <section class="max-w-[1280px] mx-auto py-12">

            <div class="flex gap-5 items-start">
                <video width="850" height="518" controls class="rounded-2xl shadow-lg">
                    <source src="../../../video/video.mp4" type="video/mp4">
                    Your browser does not support the video tag.
                </video>

                <div class="w-full">
                    <?php while ($chapter = $chapters->fetch_assoc()): ?>
                        <div class="collapse collapse-arrow bg-base-100 border border-base-300">
                            <input type="radio" name="my-accordion-2" />
                            <div class="collapse-title font-semibold"><?= htmlspecialchars($chapter['title']) ?></div>
                            <div class="collapse-content flex flex-col items-start gap-2">
                                <?php
                                $topic_stmt = $conn->prepare("SELECT title FROM topics WHERE chapter_id=?");
                                $topic_stmt->bind_param("i", $chapter['id']);
                                $topic_stmt->execute();
                                $topics = $topic_stmt->get_result();
                                while ($topic = $topics->fetch_assoc()):
                                ?>
                                    <div class="p-2 bg-[#EFEBF5] w-full rounded-lg font-semibold"><?= htmlspecialchars($topic['title']) ?></div>
                                <?php endwhile; ?>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>



        </section>



        <?php include "../component/footer.php" ?>


    </body>

    </html>