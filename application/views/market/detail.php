<form id="regForm">
    <div class="tab">

        <div class="head d-flex justify-content-center">
            <h4>PRODUCT DETAIL</h4>
        </div>
        <div class="wrap d-flex justify-content-center">
            <div class="containt d-flex justify-content-around align-item-center">
                <div class="image">

                </div>
                <div class="product">
                    <?php foreach ($product as $p) :
                        $discount = ($p['discount'] / 100) * $p['price'];
                        $harga = $p['price'] - $discount; ?>
                        <h3><?= $p['product_name'] ?></h3>
                        <p><s><?= $p['price'] ?></s></p>
                        <h4>Rp.<?= str_replace(',', '.', number_format($harga))  ?></h4>
                        <h5>Dimension : <?= $p['dimension'] ?></h5>
                        <h5>Price Unit : <?= $p['unit'] ?></h5>
                    <?php endforeach ?>
                    <div class="btn d-flex justify-content-end">
                        <a href="<?= base_url('market') ?>" class="tombol"><button type="button">BUY</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>