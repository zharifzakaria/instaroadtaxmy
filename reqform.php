<form id="reqForm" method="POST" action="" class="needs-validation" novalidate>
  <div class="form-group pb-3">
    <div class="pos-rel">
      <select class="form-control my-2" name="type" required>
        <option selected disabled value="">Pilih Jenis Kenderaan:</option>
        <option value="KERETA">Kereta</option>
        <option value="MOTOSIKAL">Motosikal</option>
      </select>
      <div class="invalid-tooltip">
        <p class="mb-0" style="font-size:14px">Pilih jenis kenderaan.</p>
      </div>
    </div>
    <div class="pos-rel">
      <input inputmode="text" type="text" pattern="^[\S]+$" class="form-control my-2" name="plate" onblur="this.value = this.value.toUpperCase();" placeholder="No. Plat Kenderaan (ABC123)" required />
      <div class="invalid-tooltip">
        <p class="mb-0" style="font-size:14px">Masukkan No. Pendaftaran Kenderaan</p>
      </div>
    </div>
    <div class="pos-rel">
      <input inputmode="tel" type="number" class="form-control my-2" name="postcode" oninput="maxLengthCheck(this,5)" placeholder="Poskod (56000)" required />
      <div class="invalid-tooltip">
        <p class="mb-0" style="font-size:14px">Masukkan Poskod</p>
      </div>
    </div>
    <div class="pos-rel">
      <input inputmode="tel" type="text" pattern=".{12,14}" class="form-control my-2" name="icno" onblur="formatIC(this)" oninput="maxLengthCheck(this,12)" placeholder="No. K/P (500505051234)" required />
      <div class="invalid-tooltip">
        <p class="mb-0" style="font-size:14px">Masukkan No. Kad Pengenalan</p>
      </div>
    </div>
    <div class="pos-rel">
      <input inputmode="tel" type="text" pattern=".{9,12}" class="form-control my-2" name="phone" oninput="maxLengthCheck(this,12)" placeholder="No. Telefon (0123456789)" required />
      <div class="invalid-tooltip">
        <p class="mb-0" style="font-size:14px">Masukkan No. Telefon Bimbit</p>
      </div>
    </div>
    <div class="pos-rel">
      <input inputmode="email" type="email" class="form-control my-2" name="email" placeholder="Emel (nama@emel.com)" required />
      <div class="invalid-tooltip">
        <p class="mb-0" style="font-size:14px">Masukkan emel yang sah.</p>
      </div>
    </div>

  </div>
  <div class="d-flex">
    <button id="submitReq" type="submit" name="submit" class="col-12 col-lg-11 btn btn-warning btn-lg btn-block text-white mx-auto fw-bold">Hantar</button>
  </div>
</form>