<?php
session_start();
$title = "Accueil";
include ('partials/_header.php');
include ('helpers/functions.php');
require_once ('helpers/pdo.php');

$sql = "SELECT * FROM leader";
$query = $pdo->prepare($sql);
$query->execute();
$members = $query->fetchAll();
#debug_array($members);
?>

<main>
    <div class="wrap_content-head text-center my-10">
        <h1 class="text-blue-500 font-black text-5xl ">Ma base de données</h1>

        <?php
        if ($_SESSION["error"]) { ?>
            <div class="bg-red-400 py-3 mt-3 mx-72 text-lg font-bold text-white">
                <?= $_SESSION ["error"] ?>
            </div>
        <?php } elseif ($_SESSION["success"]) { ?>
           <div class="bg-green-400 py-3 mt-3 mx-72 text-lg font-bold text-white">
                <?= $_SESSION ["success"]; ?>
            </div>
        <?php }
        #$_SESSION["error"] = [];
        #$_SESSION["success"] = [];
        ?>
    </div>
    <div class="overflow-x-auto mx-10">
        <table class="table w-full">
            <!-- head -->
            <thead>
                <tr>
                    <th></th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Statut</th>
                    <th>Sexe</th>
                    <th>Année d'adhésion</th>
                    <th>Plus d'info</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (count($members) == 0) {
                    echo "<tr><td class=text-center>Pas de jeux disponibles actuellement.</td></tr>";
                }else { ?>
                    <?php foreach ($members as $member) : ?>
                        <tr>
                            <th><?= $member ['id'] ?></th>
                            <td><?= $member ['nom'] ?></td>
                            <td><?= $member ['prenom'] ?></td>
                            <td><?= $member ['statut'] ?></td>
                            <td><?= $member ['sexe'] ?></td>
                            <td><?= $member ['annee_adhesion'] ?></td>
                            <td class="pl-10">
                                <a href="show.php?id=<?= $member['id']?>&nom=<?= $member['nom']?>&prenom=<?= $member['prenom']?>">
                                    <img src="img/agrandir.png" alt="Voir plus" class="w-5">
                                </a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                    <?php } ?>          
            </tbody>
        </table>
    </div>
</main>


<!-- footer -->
<?php
include ('partials/_footer.php');
?>