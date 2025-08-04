<section>
    <div class="row mt-3">
        <label class="col-sm-4 col-form-label">Model</label>
        <div class="col-sm-4">
            <select name="carType" id="selectCar" class="form-select form-select-sm" aria-label=".form-select-sm example" required>
                <option selected disabled value="">Pilih model:</option>
                <?php
                foreach ($car_model as $i => $car) {
                    echo "<option value=\"" . $car . "\">" . strtoupper($car) . "</option>";
                }
                ?>
            </select>
            <input type="hidden" name="carModel" id="carModelVar" />
        </div>
        <div class="col-sm-4">
            <p class="fs-6 lh-1 pt-2 pt-lg-0"><span class="text-dark badge rounded-pill bg-warning" style="cursor: pointer;" onClick="myopen('https://www.motortakaful.com/motorcar/bm/takaful/getquote1')"> Semak Maklumat Kenderaan</span> <?php echo "$plate"; ?></p>
        </div>
        <div class="invalid-tooltip">
            <p style="font-size:14px">Pilih model.</p>
        </div>
    </div>

    <div class="row mt-2">
        <label class="col-sm-4 col-form-label">Varian</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" id="carVariant" value="" name="carVariant" onblur="getCarModel()" required>
        </div>
        <div class="invalid-tooltip">
            <p style="font-size:14px">Pilih model.</p>
        </div>
    </div>

    <div>
        <div class="row mt-3">
            <label class="col-sm-4 col-form-label">Manufacture Year</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" value="" name="year" required>
            </div>
        </div>
        <div class="row mt-3">
            <label class="col-sm-4 col-form-label">Engine CC</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" value="" name="engineCC" required>
            </div>
        </div>

        <div class="row mt-3">
            <label class="col-sm-4 col-form-label">Roadtax Price</label>
            <div class="col-sm-4">
                <div id="rtpResult" class="input-group mb-3">
                    <span class="input-group-text">RM</span>
                    <input type="text" class="form-control" aria-label="Cukai Jalan" name="rtPrice" required>
                </div>
            </div>
        </div>

    </div>
</section>

<script>
    function getCarModel() {
        document.getElementById('carModelVar').value = document.getElementById('selectCar').value.toUpperCase() + " " + document.getElementById('carVariant').value.toUpperCase();
        
    }
</script>