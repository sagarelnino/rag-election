<h1>Your Request to RAG43 Election</h1>

@if ($is_approved == 'approve')
    Congratulations!!!<br />
    Your request to RAG43 Election has been approved. <br />
    You can login to explore.
    <a href="{{ route('login') }}">Login</a>
    <br />
    <h3>Notice</h3>
    <li>You have to cast your vote within Bangladesh time 9AM-7 PM(February 10, 2023)</li>
    <li>After login you will see a green Elections button. Click on the button</li>
    <li>You will see a election list. Click on the VOTE button</li>
    <li>You will be redirected to the election details page</li>
    <li>Here you can see the king & queen options</li>
    <li>Choose one king and one queen and submit your vote</li>
    <li>That's it</li>
    <br />
    <h4>হৃদয় সুতোয় আখর টেনে <br />
        বন্ধুই জানে বন্ধুর মানে৷</h4>
@else
    Sorry!!!<br />
    Unfortunately we are unable to approve your request to join the RAG43 Election.
@endif
