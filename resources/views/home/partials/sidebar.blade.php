<button class="btn btn-success form-control m-2">Deposit {{ Auth::check() && Auth::user()->deposit ? Auth::user()->deposit : 0 }} rsd</button>
<a href="" class="btn btn-secondary form-control m-2">All ads</a>
<a href="" class="btn btn-secondary form-control m-2">Add deposit</a>
<a href="" class="btn btn-secondary form-control m-2">Messages</a>
<a href="" class="btn btn-primary form-control m-2">New Ad</a>