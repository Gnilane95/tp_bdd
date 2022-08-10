<?php
session_start();
$title = "Show";
include ('partials/_header.php');
include ('helpers/functions.php');
require_once ('helpers/pdo.php');
#debug_array($_GET);

if (!empty($_GET['id']) && is_numeric($_GET['id'])) {
    $id = clear_xss($_GET['id']);
    $sql = "SELECT * FROM leader WHERE id=:id";
    $query = $pdo->prepare($sql);
    $query->bindValue(':id',$id, PDO::PARAM_INT);
    $query->execute();
    $member = $query->fetch();
    #debug_array($member);
    #$member=[];
    if (!$member) {
        $_SESSION["error"]="Ce jeu est indisponible !";
        header("Location: index.php");
    }
}else {
    $_SESSION["error"]="URL invalide !";
    header("Location:index.php");
}
?>

<main class="mx-20 my-12">
    <div class="wrap_content-head text-center mb-20">
        <h1 class="text-blue-500 font-bold text-5xl"><?= $member ['prenom']?></h1>
    </div>
    <div class="flex items-center mx-48 mt-10">
        <img src="img/Certification.png" alt="" class="w-72 shadow-md rounded-xl">
        <p class="px-20"><?= $member ["presentation"] ?></p>
    </div>
    <a href="delate.php?id=<?= $member["id"] ?>&nom=<?= $member["nom"] ?>" class="btn btn-error mt-10 ml-48">Supprimer le jeu</a>
</main>

<!-- footer -->
<?php
include ('partials/_footer.php');
?>