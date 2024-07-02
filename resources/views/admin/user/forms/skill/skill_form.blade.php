<div class="modal-body">
    <div class="form-body">
        <div class="form-group" id="div_job_skill_id">
            <label for="job_skill_id" class="bold">Job Skill</label>
            <?php
            $job_skill_id = (isset($profileSkill) ? $profileSkill->job_skill_id : null);
            ?>
            {!! Form::select('job_skill_id', $jobSkills, $job_skill_id, array('class'=>'form-control select2-multiple', 'id'=>'job_skill_id','multiple'=>'multiple')) !!} <span class="help-block job_skill_id-error"></span> </div>
            <div class="form-group" id="div_job_experience_id">
            <label for="job_experience_id" class="bold">Job Experience</label>
            <?php
            $job_experience_id = (isset($profileSkill) ? $profileSkill->job_experience_id : null);
            ?>
            {!! Form::select('job_experience_id', [''=>'Select experience']+$jobExperiences, $job_experience_id, array('class'=>'form-control', 'id'=>'job_experience_id')) !!} <span class="help-block job_experience_id-error"></span> </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.select2-multiple').select2({
            placeholder: 'Select a skill',
            allowClear: true, // Optional, if y ou want a clear button
            // Add additional options as needed
        });
    });
</script>