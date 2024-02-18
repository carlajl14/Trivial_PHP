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
                <div class="form-group mt-2">
                    <label for="category">Categoría</label>
                    <select class="form-control" name="category">
                        <option value="">Elige una categoría</option>
                        <?php
                        //Obtener las categorías
                        $categories = file_get_contents("https://opentdb.com/api_category.php");
                        $categorie = json_decode($categories, true);
                        if (isset($categorie)) {
                            foreach ($categorie['trivia_categories'] as $category) {
                                echo '<option value="' . $category['id'] . '">' . $category['name'] . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group mt-2">
                    <label for="category">Dificultad</label>
                    <select class="form-control" name="difficulty">
                        <option value="">Elige la dificultad</option>
                        <?php
                        //Obtener la dificultad
                        echo '<option value="easy">Easy</option>';
                        echo '<option value="medium">Medium</option>';
                        echo '<option value="hard">Hard</option>';
                        ?>
                    </select>
                </div>
                <input type="submit" name="start" value="Comenzar" class="btn btn-primary mt-2">
            </form>
            <?php
            //Comprobar si los parámetros se han elegido
            if (isset($_POST['start']) && isset($_POST['amount']) && isset($_POST['category'])) {
                $amount = $_POST['amount'];
                $category = $_POST['category'];
                $difficulty = $_POST['difficulty'];

                //Obtener los datos de la API
                $questions = file_get_contents("https://opentdb.com/api.php?amount=" . $amount . "&category=" . $category . "&difficulty=" . $difficulty);
                $dataQuestions = json_decode($questions, true);
                $cont = 0;
                
                //Recorrer el array de datos
                foreach ($dataQuestions['results'] as $data) {
                    echo '<h2>Preguntas</h2>';
                    $cont++;
                    echo '<h3>Pregunta ' . $cont . '</h3>';
                    echo $data['question'] . '<br>';
                    echo '<ul>';
                    echo '<li>' . $data['correct_answer'] . '</li>';
                    //Recorrer el subarray
                    foreach($data['incorrect_answers'] as $incorrect) {
                        echo '<li>' . $incorrect . '</li>';
                    }
                    echo '</ul>';
                }
            }
            ?>
        </div>
    </body>
</html>
