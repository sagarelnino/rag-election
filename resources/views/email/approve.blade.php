<h1>Your Request to RAG43 Election</h1>

@if ($is_approved == 'approve')
    Congratulations!!!<br />
    Your request to RAG43 Election has been approved. You can login to explore.

    <a href="{{ route('login') }}">Login</a>
@else
    Sorry!!!<br />
    Unfortunately we are unable to approve your request to join the RAG43 Election.
@endif
