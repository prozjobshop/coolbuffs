{!! APFrmErrHelp::showErrorsNotice($errors) !!}
@include('flash::message')
<div class="form-body">
    <fieldset>
        <legend>Enter Analytics Code:</legend>
        <div class="form-group {!! APFrmErrHelp::hasError($errors, 'ganalytics') !!}">
           
			{!! Form::textarea('ganalytics', null, array('class'=>'form-control', 'contenteditable'=>'true', 'id'=>'ganalytics', 'placeholder'=>'Add Analytics Code Here')) !!}
			
			
            {!! APFrmErrHelp::showErrors($errors, 'ganalytics') !!}    
        </div>        
    </fieldset>


    <fieldset>
        <legend>Google Tag Manager for Head:</legend>
        <div class="form-group {!! APFrmErrHelp::hasError($errors, 'google_tag_manager_for_head') !!}">
           
			{!! Form::textarea('google_tag_manager_for_head', null, array('class'=>'form-control', 'contenteditable'=>'true', 'id'=>'google_tag_manager_for_head', 'placeholder'=>'Add Google Tag Manager for Head Code Here')) !!}
			
			
            {!! APFrmErrHelp::showErrors($errors, 'google_tag_manager_for_head') !!}    
        </div>        
    </fieldset>

    <fieldset>
        <legend>Google Tag Manager for Body:</legend>
        <div class="form-group {!! APFrmErrHelp::hasError($errors, 'google_tag_manager_for_body') !!}">
           
			{!! Form::textarea('google_tag_manager_for_body', null, array('class'=>'form-control', 'contenteditable'=>'true', 'id'=>'google_tag_manager_for_body', 'placeholder'=>'Add Google Tag Manager for Body Code Here')) !!}
			
			
            {!! APFrmErrHelp::showErrors($errors, 'google_tag_manager_for_body') !!}    
        </div>        
    </fieldset>

</div>
