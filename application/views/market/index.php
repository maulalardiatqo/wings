<form id="regForm" action="/action_page.php">
    <!-- Circles which indicates the steps of the form: -->
    <div id="stepper" style="margin-top:20px;margin-bottom:40px;display:flex;justify-content:space-between;position:relative;">
        <span class="step"></span>
        <span class="step"></span>
        <span class="step"></span>
        <div class="line"></div>
    </div>
    <!-- One "tab" for each step in the form: -->
    <div class="tab">
        <div class="product-list">
            <?php foreach ($product as $p) :
                $discount = ($p['discount'] / 100) * $p['price'];
                $harga = $p['price'] - $discount;
            ?>
                <div class="containt d-flex space-between align-item-center">
                    <div class="row d-flex">
                        <div class="image">

                        </div>
                        <div class="wrap-content">
                            <h5><a href=""></a><?= $p['product_name'] ?></h5>
                            <h4><s>Rp.<?= $p['price'] ?></s> </h4>
                            <h3>Rp.<?= str_replace(',', '.', number_format($harga))  ?></h3>
                        </div>
                    </div>
                    <button type="button" class="buy" onclick="buy('<?= implode(',', $p) ?>')">BUY</button>
                </div>

            <?php endforeach ?>
        </div>
    </div>
    <div class="tab">
        <div class="containt d-flex space-between align-item-center flex-column" id="wish-list">

        </div>
        <div class="total d-flex justify-content-center" style="border: 1px solid black; margin-bottom:5px;">
            <h2>TOTAL : Rp.<span id="total-harga"></span></h2>
        </div>
    </div>
    <div class="tab">
        <div class="container d-flex justify-content-center flex-column">
            <h1>Pesanan Anda Telah Di Proses</h1>
            <a href="<?= base_url('market') ?>" type="button">Kembali Berbelanja</a>
            <div id="base_url">
                <?= base_url('market/transaction') ?>
            </div>
        </div>
    </div>
    <div style="overflow:auto; width:100%; display:flex; justify-content:center;">
        <div style="float:right;">
            <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
            <button type="button" id="nextBtn" onclick="nextPrev(1)">CHECKOUT</button>

        </div>
    </div>

</form>