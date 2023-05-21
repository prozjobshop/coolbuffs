<div class="modal-body">
    <div class="form-body">
        <div id="div_language_id">
            <?php
            $language_id = (isset($profileLanguage) ? $profileLanguage->language_id : null);
            ?>
            {!! Form::select('language_id', [''=>__('Select language')]+$languages, $language_id, array('class'=>'form-control', 'id'=>'language_id')) !!} <span class="help-block language_id-error text-danger"></span> </div>
            
            <p id="if_skill_already_exists" class="text-danger"></p>

        <div class="formrow mt-3" id="div_language_level_id">
            <?php
            $language_level_id = (isset($profileLanguage) ? $profileLanguage->language_level_id : null);
            ?>
            {!! Form::select('language_level_id', [''=>__('Select Language Level')]+$languageLevels, $language_level_id, array('class'=>'form-control', 'id'=>'language_level_id')) !!} <span class="help-block language_level_id-error text-danger"></span> </div>
    </div>
</div>
