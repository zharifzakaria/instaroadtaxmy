<section>
    <div class="row mt-3">
        <label class="col-sm-4 col-form-label">Model Motosikal</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" value="" name="carModel" required>
        </div>
        <div class="col-sm-4">
            <p class="fs-6 lh-1 pt-2 pt-lg-0"><span class="text-dark badge rounded-pill bg-warning" style="cursor: pointer;" onClick="myopen('https://www.motortakaful.com/motorcar/bm/takaful/getquote1')"> Semak Maklumat Kenderaan</span> <?php echo "$plate"; ?></p>
        </div>
        <div class="invalid-tooltip">
            <p style="font-size:14px">Pilih model.</p>
        </div>
    </div>

    <div>
        <div class="row mt-2">
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
            <div class="col-sm-4">
                <p class="fs-6 lh-1"><span class="text-dark badge rounded-pill bg-warning" style="cursor: pointer;" onClick="myopen('https://myrakan.com:8443/misc/cukaijalan.php')"> Semak Roadtax</span></p>
            </div>
            <div class="invalid-tooltip">
                <p style="font-size:14px">Isikan cukai jalan.</p>
            </div>
        </div>

    </div>
</section>