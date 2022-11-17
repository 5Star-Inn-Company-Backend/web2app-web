

@extends('include.layouts')

@section('content') 
  <br><br><br><br>
     <form>
    <script src="https://korablobstorage.blob.core.windows.net/modal-bucket/korapay-collections.min.js"></script>

    <button type="button" onclick="payKorapay()"> Pay </button>
</form>

<script>
    function payKorapay() {
        window.Korapay.initialize({
            key: "pk_test_anzFtm3VwRFjdHQpfkJ5JJ1NvHAtaNhq7jHiAfd5", 
            amount: 22000, 
            currency: "NGN",
            customer: {
              name: "John Doe",
              email: "priscavincent2018@gmail.com"
            },
            notification_url: "https://example.com/webhook"
        });
    }
</script>
@endsection
