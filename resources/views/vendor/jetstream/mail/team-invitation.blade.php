@extends('mail.mail-layout')
@section('content')
<table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
            <tr>
                <td class="bg_white email-section">
                    <div class="heading-section" style="text-align: center; padding: 0 30px;">                      
                      
                        
                        <p>{{ __('You have been invited to join the :team!', ['team' => $invitation->team->name]) }}</p>

                        @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::registration()))
                        <p>{{ __('If you do not have an account, you may create one by clicking the button below. After creating an account, you may click the invitation acceptance button in this email to accept the team invitation:') }}</p>
                        <br/>                      
                        <p><a class="btn btn-primary" href="{{ route('register') }}" >{{ __('Create Account') }}</a></p>
                        <br/>
                        <p>{{ __('If you already have an account, you may accept this invitation by clicking the button below:') }}</p>

                        @else
                        <p>{{ __('You may accept this invitation by clicking the button below:') }}</p>
                        @endif


                        <br/>
                        <p><a class="btn btn-primary" href="{{ $acceptUrl }}" >{{ __('Accept Invitation') }}</a></p>
                        <br/>
                        <p>{{ __('If you did not expect to receive an invitation to this team, you may discard this email.') }}</p>
                        
                      
                    </div>
                </td>
            </tr>
</table> 	
@stop