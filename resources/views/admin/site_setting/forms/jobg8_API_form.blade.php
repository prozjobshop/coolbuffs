{!! APFrmErrHelp::showErrorsNotice($errors) !!}
@include('flash::message')
<div class="form-body">
    <fieldset>
        <legend>Enter Username:</legend>
        <div class="form-group {!! APFrmErrHelp::hasError($errors, 'username_jobg8') !!}">
           
			{!! Form::text('username_jobg8', null, array('class'=>'form-control', 'contenteditable'=>'true', 'id'=>'username_jobg8', 'placeholder'=>'Enter Username Here')) !!}
			
			
            {!! APFrmErrHelp::showErrors($errors, 'username_jobg8') !!}    
        </div>        
    </fieldset>


    <fieldset>
        <legend>Enter Password:</legend>
        <div class="form-group {!! APFrmErrHelp::hasError($errors, 'password_jobg8') !!}">
           
			{!! Form::text('password_jobg8', null, array('class'=>'form-control', 'contenteditable'=>'true', 'id'=>'password_jobg8', 'placeholder'=>'Enter Password Here')) !!}
			
			
            {!! APFrmErrHelp::showErrors($errors, 'password_jobg8') !!}    
        </div>        
    </fieldset>

    <fieldset>
        <legend>Enter Account Number:</legend>
        <div class="form-group {!! APFrmErrHelp::hasError($errors, 'accountnumber_jobg8') !!}">
           
			{!! Form::text('accountnumber_jobg8', null, array('class'=>'form-control', 'contenteditable'=>'true', 'id'=>'accountnumber_jobg8', 'placeholder'=>'Enter Account Number')) !!}
			
			
            {!! APFrmErrHelp::showErrors($errors, 'accountnumber_jobg8') !!}    
        </div>        
    </fieldset>

    <fieldset>
        <legend>If you want to import jobs from jobg8 api then click on this link:</legend>
        <a target="_blank" href="{{url('/job8')}}">{{url('/job8')}}</a>   
    </fieldset>

</div>
