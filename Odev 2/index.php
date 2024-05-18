<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title><?php echo $baslik ?></title>
</head>

<body>
    <div class="container">
        <h1><?php $baslik = "FİLM LİSTESİ";
            echo $baslik ?></h1>
        <div class="row">
            <div class="col-3">
                <ul class="list-group">
                    <?php
                    $kategori = array("Macera", "Dram", "Komedi", "Korku");
                    array_push($kategori, "Biyografi");
                    sort($kategori); // alfabetik sıraya göre dizer.

                    foreach ($kategori as $kategoriler) {
                        echo '<li class="list-group-item">' . $kategoriler . '</li>';
                    }
                    ?>
                </ul>

            </div>
            <div class="col-9">
                <?php
                $filmler = array(
                    "1" => array(
                        "baslik" => "Paper Lives",
                        "aciklama" => "Kağıt toplayarak geçinen ve sağlığı giderek kötüleşen Mehmet terk edilmiş bir çocuk bulur. Birden hayatına giren küçük Ali, onu kendi çocukluğuyla yüzleştirecektir. (18 yaş ve üzeri için uygundur)",
                        "resim" => "1.jpeg",
                        "yorumSayisi" => "0",
                        "begeniSayisi" => "106",
                        "yapimTarihi" => "03.12.2021",
                        "vizyon" => true
                    ),
                    "2" => array(
                        "baslik" => "Walking Dead",
                        "aciklama" => "Zombi kıyametinin ardından hayatta kalanlar, birlikte verdikleri ölüm kalım mücadelesinde insanlığa karşı duydukları umuda tutunur.",
                        "resim" => "2.jpeg",
                        "yorumSayisi" => "236",
                        "begeniSayisi" => "1023",
                        "yapimTarihi" => "31.10.2010",
                        "vizyon" => false
                    ),
                );
                function filmEkle(
                    string $baslik,
                    string $aciklama,
                    string $resim,
                    int $yorumSayisi = 0,
                    int $begeniSayisi = 0,
                    bool $vizyon = false,
                    string $url,
                    string $yapimTarihi
                ) {
                    global $filmler;
                    $new_item[count($filmler) + 1] = array(
                        "baslik" => $baslik,
                        "aciklama" => $aciklama,
                        "resim" => $resim,
                        "yorumSayisi" => $yorumSayisi,
                        "begeniSayisi" => $begeniSayisi,
                        "vizyon" => $vizyon,
                        "url" =>  $url,
                        "yapimTarihi" => $yapimTarihi
                    );

                    $filmler = array_merge($filmler, $new_item);
                }

                filmEkle(
                    "Lucifer",
                    "Bored with being the Lord of Hell, the devil relocates to Los Angeles, where he opens a nightclub and forms a connection with a homicide detective.",
                    "3.jpeg",
                    "71",
                    "0",
                    true,
                    "lucifer",
                    "21.10.2020"
                );

                filmEkle(
                    "Lucifer 2",
                    "Bored with being the Lord of Hell, the devil relocates to Los Angeles, where he opens a nightclub and forms a connection with a homicide detective.",
                    "3.jpeg",
                    "71",
                    "0",
                    true,
                    "lucifer",
                    "21.10.2020"
                );
                foreach ($filmler as $id => $film) {
                ?>
                    <div class="card mb-3">
                        <div class="row">
                            <div class="col-3">
                                <?php echo
                                "<img class=\"img-fluid\" src=\"img/{$film["resim"]}\"  >"
                                ?>
                            </div>
                            <div class="col-9">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <a class="text-dark" href="<?php echo "" . strtolower(str_replace(' ', '-', $film['baslik'])) . ".php" ?>">
                                            <?php echo $film['baslik'] ?>
                                        </a>
                                    </h5>
                                    <p class="card-text"><?php echo substr(ucfirst(strtolower($filmler[1]["aciklama"])), 0, 50) . "..." ?></p>
                                    <div>
                                        <span class="badge bg-success">Yapım Tarihi: <?php echo $film["yapimTarihi"] ?></span>
                                        <?php
                                        $final = $film["yorumSayisi"] > 0 ?
                                            "<span class='badge bg-success'>Yorum: {$filmler['1']['yorumSayisi']}</span>"
                                            :  "";
                                        echo $final;
                                        ?>
                                        <span class="badge bg-success">Beğeni: <?php echo $film["begeniSayisi"] ?></span>
                                        <span class="badge bg-success">Vizyon: <?php echo $film["vizyon"] ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>