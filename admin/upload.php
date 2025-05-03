<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload</title>
</head>

<body><!-- form.php -->
    <form action="insert_topic.php" method="POST">
        <select name="class_id">
            <option value="1">Class Six</option>
            <option value="1">Class Seven</option>
            <option value="1">Class Eignt</option>
            <option value="1">Class Six</option>
            <option value="1">Class Six</option>
            <option value="1">Class Six</option>
            <option value="1">Class Six</option>
            <option value="1">Class Six</option>
            <!-- Add more classes here -->
        </select>
        <input type="text" name="chapter_title" placeholder="Chapter Title" required>
        <input type="text" name="topic_title" placeholder="Topic Title" required>
        <input type="text" name="video_url" placeholder="Video URL (optional)">
        <button type="submit">Upload</button>
    </form>


</body>

</html>