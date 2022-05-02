<?php
                    /**
                     * Gestion de l'image qu'il faudrait externaliser
                     */
                    $target_dir = "img/";
                    $target_file = $target_dir . basename($_FILES["image"])."test".".jpg";
                    $uploadOk = 1;
                    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                    $ImageNameDB = ($_FILES["image"]["name"]) ? $_FILES["image"]["name"] : "";
                    // Check if image file is a actual image or fake image
                    if (isset($_FILES["image"]) && !empty($ImageNameDB)) {
                        $check = getimagesize($_FILES["image"]["tmp_name"]);

                        //   var_dump($_FILES["image"]);die;
                        // si le check est = à false on peut décider de ne pas enregistrer en BDD par exemple
                        if ($check !== false) {
                            echo "Image OK - " . $check["mime"] . ".";
                            $uploadOk = true;
                            // de meme si l'image n'a pas été téléchargé sur le serveur
                            if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                                echo "Le fichier est valide, et a été téléchargé avec succès. Voici plus d'informations :\n";
                            } else {
                                // cf doc de move_uploaded_file
                                echo "Attaque potentielle par téléchargement de fichiers. Voici plus d'informations :\n";
                            }
                        } else {
                            echo "L'image est incorrect.";
                            $uploadOk = false;
                        }
                    }


                    ?>