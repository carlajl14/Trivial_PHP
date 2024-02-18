<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Trivial</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <link rel="stylesheet" href="https://kit.fontawesome.com/45d72edd49.css" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <h1 class="text-center">Trivial</h1>
            <form method="POST">
                <div class="form-group">
                    <label for="amount">Número de preguntas:</label>
                    <input type="number" name="amount" class="form-control" min="1" max="50">
                </div>
                <div class="form-group">
                    <label for="category">Categoría</label>
                    <select class="form-control" name="category">
                        <option value="">Elige una categoría</option>
                        <?php
                        //Obtener las categorías
                        $categories = file_get_contents("https://opentdb.com/api_category.php");
                        $categorie = json_decode($categories, true);
                        if (isset($categorie)) {
                            foreach ($categorie['trivia_categories'] as $category) {
                                echo '<option value="' . $category['name'] . '">' . $category['name'] . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
                <input type="submit" name="start" value="Comenzar" class="btn btn-primary">
            </form>
        </div>
    </body>
</html>
