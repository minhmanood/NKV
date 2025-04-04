<div class="row container-element">
    <div class="col-md-3">
        <div class="input-group">
            <span class="input-group-btn">
                <button type="button" class="btn btn-danger remove-element"> <i class="fa fa-trash"></i></button>
            </span>
            <input type="text" class="form-control" name="<?php echo $attribute; ?>[label][]" value="" placeholder="Tiêu đề">
        </div>
    </div>
    <div class="col-md-6">
        <textarea class="form-control" name="<?php echo $attribute; ?>[content][]" data-autoresize rows="3" placeholder="Nội dung"></textarea>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="control-label">Hình ảnh</label>
            <input type="file" class="file" name="<?php echo $attribute; ?>[image][]">
            <input type="hidden" name="<?php echo $attribute; ?>[image][]" value="">
        </div>
    </div>
    <div class="col-md-12">
        <hr>
    </div>
</div>