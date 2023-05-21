@extends('admin.layouts.email_template')
@section('content')
<table border="0" cellpadding="15" cellspacing="0" class="force-row" style="width: 100%; border-bottom: solid 1px #ccc; padding: 25px;">
  
    <tr>
        <td class="cols-wrapper" style="padding-left:12px;padding-right:12px"><!--[if mso]>
         <table border="0" width="576" cellpadding="0" cellspacing="0" style="width: 576px;">
            <tr>
               <td width="192" style="width: 192px;" valign="top">
                  <![endif]--> 

			<p style="font-family: Helvetica, Arial, sans-serif; font-size: 16px;font-weight:400;color: #000;text-align: left; margin:15px 0 0 0;">{{ $subject }}</p>
			
			
			
            <?php if(null!==($jobs)){?> 
		<?php foreach ($jobs as $key => $job) {?>
		<?php $company = $job->getCompany(); ?> 
		<?php if(isset($company)){?>
			<div style="border-top: 1px solid #ddd; padding-top: 15px; margin-top: 15px;">
			<a href="{{route('job.detail', [$job->id,$job->slug])}}" target="_blank" data-saferedirecturl="https://www.google.com/url?q={{route('job.detail', [$job->id,$job->slug])}}" style="font-family:Helvetica, Arial, sans-serif; color: #0036CA; display: inline-block;">{{$job->title}}</a>
			
			<p style="font-family: Helvetica, Arial, sans-serif; font-size: 16px;font-weight:400;color: #000;text-align: left; margin:15px 0 0 0;">{{$company->name}}</p>
				
			<p style="font-family: Helvetica, Arial, sans-serif; font-size: 16px;font-weight:400;color: #000;text-align: left; margin:15px 0 0 0;">{{$company->location}}</p>
				
			<p style="font-family: Helvetica, Arial, sans-serif; font-size: 16px;font-weight:400;color: #000;text-align: left; margin:15px 0 0 0;">{{ \Carbon\Carbon::parse($job->created_at)->diffForHumans()}}</p>
				
			@if(isset($link))
				<a style="font-family:Helvetica, Arial, sans-serif; color: #0036CA; display: inline-block; margin-top: 10px;" href="{{$link}}">Make Disable</a>
			@endif
			</div>
		<?php } ?>
		<?php } ?>
		<?php } ?>
			
            <!--[if mso]>
               </td>
            </tr>
         </table>
         <![endif]--></td>
    </tr>
</table>
@endsection