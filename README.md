WHY NOT A GIF HERE? TO SET THE MODE.

# Albero

This is an island filled with all the trees you could imagine. People? No. Trees? Yes.
At island Albero (italian for tree), you can hang in trees, hug trees, talk with trees, eat some pie beside a tree. You get the picture.

# Treehotel

In this hotel our guests gets to explore the tree-tops, from their room. We provide the finest (and some not that fine) treehouses in the world, high up in the trees.

# Instructions

If your project requires some installation or similar, please inform your user 'bout it. For instance, if you want a more decent indentation of your .php files, you could edit [.editorconfig]('/.editorconfig').

# Code review

1. connection-db.php:28-57 - Instead of echoing out each error you could make an $error array that can hold them and then echo them out in a loop. This would make your code more readable and easier to maintain.
2. .env.example1:1 - If that is your real API_KEY remember that the example file should not have any real data in it. You should use a placeholder instead.(if that is not your real API_KEY, ignore this comment)
3. connection-db.php :28-57 - It's generally not good practice to nest if statements, only use them if they are directly related to each other. You could use a switch statement instead. This would make your code more readable.
4. all the files - It's generally good practice to comment allot to make it easier to comeback to.
5. index.php:74 - Here you open a section but never close it.
6. index.php:77 - br looks different in some browsers, it's better to use css for this.
7. main.css:12 - it's good practice to remove commented code at the end of a project.
8. header.css - Here you use %, px and rem for margins generally it's better to use one of them.
9. index.php:58 - small tip, you can use the php shorthand for echo, <?= $var ?>. This is the same as <?php echo $var ?>. It's just a bit shorter.
10. index.php:41 - To save time and confusion in the future it's better to set width and height in the css file where all the other styling is.
