@extends('layouts.main')
<style type="text/css">
    body {
        font-family: 'Roboto Mono', monospace;
    }
</style>
@section('content')
    <script type="text/javascript">
        document.write(unescape(
            '%3c%64%69%76%20%63%6c%61%73%73%3d%22%6d%69%6e%2d%77%2d%73%63%72%65%65%6e%20%6d%69%6e%2d%68%2d%73%63%72%65%65%6e%20%62%67%2d%67%72%61%79%2d%32%30%30%20%66%6c%65%78%20%69%74%65%6d%73%2d%63%65%6e%74%65%72%20%6a%75%73%74%69%66%79%2d%63%65%6e%74%65%72%20%70%78%2d%35%20%70%79%2d%35%22%3e%0d%0a%20%20%20%20%20%20%20%20%3c%64%69%76%20%63%6c%61%73%73%3d%22%72%6f%75%6e%64%65%64%2d%6c%67%20%73%68%61%64%6f%77%2d%78%6c%20%62%67%2d%67%72%61%79%2d%39%30%30%20%74%65%78%74%2d%77%68%69%74%65%22%3e%0d%0a%20%20%20%20%20%20%20%20%20%20%20%20%3c%64%69%76%20%63%6c%61%73%73%3d%22%62%6f%72%64%65%72%2d%62%20%62%6f%72%64%65%72%2d%67%72%61%79%2d%38%30%30%20%70%78%2d%38%20%70%79%2d%33%22%3e%0d%0a%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%3c%64%69%76%20%63%6c%61%73%73%3d%22%69%6e%6c%69%6e%65%2d%62%6c%6f%63%6b%20%77%2d%33%20%68%2d%33%20%6d%72%2d%32%20%72%6f%75%6e%64%65%64%2d%66%75%6c%6c%20%62%67%2d%72%65%64%2d%35%30%30%22%3e%3c%2f%64%69%76%3e%0d%0a%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%3c%64%69%76%20%63%6c%61%73%73%3d%22%69%6e%6c%69%6e%65%2d%62%6c%6f%63%6b%20%77%2d%33%20%68%2d%33%20%6d%72%2d%32%20%72%6f%75%6e%64%65%64%2d%66%75%6c%6c%20%62%67%2d%79%65%6c%6c%6f%77%2d%33%30%30%22%3e%3c%2f%64%69%76%3e%0d%0a%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%3c%64%69%76%20%63%6c%61%73%73%3d%22%69%6e%6c%69%6e%65%2d%62%6c%6f%63%6b%20%77%2d%33%20%68%2d%33%20%6d%72%2d%32%20%72%6f%75%6e%64%65%64%2d%66%75%6c%6c%20%62%67%2d%67%72%65%65%6e%2d%34%30%30%22%3e%3c%2f%64%69%76%3e%0d%0a%20%20%20%20%20%20%20%20%20%20%20%20%3c%2f%64%69%76%3e%0d%0a%20%20%20%20%20%20%20%20%20%20%20%20%3c%64%69%76%20%63%6c%61%73%73%3d%22%70%78%2d%38%20%70%79%2d%36%22%3e%0d%0a%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%3c%70%3e%3c%65%6d%20%63%6c%61%73%73%3d%22%74%65%78%74%2d%62%6c%75%65%2d%34%30%30%22%3e%63%6f%6e%73%74%3c%2f%65%6d%3e%20%3c%73%70%61%6e%20%63%6c%61%73%73%3d%22%74%65%78%74%2d%67%72%65%65%6e%2d%34%30%30%22%3e%61%62%6f%75%74%4d%65%3c%2f%73%70%61%6e%3e%20%3c%73%70%61%6e%0d%0a%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%63%6c%61%73%73%3d%22%74%65%78%74%2d%70%69%6e%6b%2d%35%30%30%22%3e%3d%3c%2f%73%70%61%6e%3e%20%3c%65%6d%20%63%6c%61%73%73%3d%22%74%65%78%74%2d%62%6c%75%65%2d%34%30%30%22%3e%66%75%6e%63%74%69%6f%6e%3c%2f%65%6d%3e%28%29%20%7b%3c%2f%70%3e%0d%0a%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%3c%70%3e%26%6e%62%73%70%3b%26%6e%62%73%70%3b%3c%73%70%61%6e%20%63%6c%61%73%73%3d%22%74%65%78%74%2d%70%69%6e%6b%2d%35%30%30%22%3e%72%65%74%75%72%6e%3c%2f%73%70%61%6e%3e%20%7b%3c%2f%70%3e%0d%0a%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%3c%70%3e%26%6e%62%73%70%3b%26%6e%62%73%70%3b%26%6e%62%73%70%3b%26%6e%62%73%70%3b%6e%61%6d%65%3a%20%3c%73%70%61%6e%20%63%6c%61%73%73%3d%22%74%65%78%74%2d%79%65%6c%6c%6f%77%2d%33%30%30%22%3e%27%54%69%6e%79%47%72%61%6d%27%3c%2f%73%70%61%6e%3e%2c%3c%2f%70%3e%0d%0a%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%3c%70%3e%26%6e%62%73%70%3b%26%6e%62%73%70%3b%26%6e%62%73%70%3b%26%6e%62%73%70%3b%44%65%73%63%72%69%70%74%69%6f%6e%3a%20%3c%73%70%61%6e%20%63%6c%61%73%73%3d%22%74%65%78%74%2d%79%65%6c%6c%6f%77%2d%33%30%30%22%3e%27%54%69%6e%79%67%72%61%6d%20%69%73%20%61%20%73%6f%63%69%61%6c%20%6d%65%64%69%61%0d%0a%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%70%6c%61%74%66%6f%72%6d%0d%0a%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%66%6f%72%20%76%69%73%75%61%6c%20%73%74%6f%72%79%74%65%6c%6c%69%6e%67%2e%27%3c%2f%73%70%61%6e%3e%2c%3c%2f%70%3e%0d%0a%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%3c%70%3e%26%6e%62%73%70%3b%26%6e%62%73%70%3b%26%6e%62%73%70%3b%26%6e%62%73%70%3b%53%6f%75%72%63%65%3a%20%3c%73%70%61%6e%20%63%6c%61%73%73%3d%22%74%65%78%74%2d%79%65%6c%6c%6f%77%2d%33%30%30%22%3e%27%3c%61%0d%0a%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%68%72%65%66%3d%22%68%74%74%70%73%3a%2f%2f%67%69%74%68%75%62%2e%63%6f%6d%2f%64%65%76%65%6c%6f%70%65%72%73%68%61%72%69%66%2f%74%69%6e%79%67%72%61%6d%22%20%74%61%72%67%65%74%3d%22%5f%62%6c%61%6e%6b%22%0d%0a%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%63%6c%61%73%73%3d%22%74%65%78%74%2d%79%65%6c%6c%6f%77%2d%33%30%30%20%68%6f%76%65%72%3a%75%6e%64%65%72%6c%69%6e%65%20%66%6f%63%75%73%3a%62%6f%72%64%65%72%2d%6e%6f%6e%65%22%3e%68%74%74%70%73%3a%2f%2f%67%69%74%68%75%62%2e%63%6f%6d%2f%64%65%76%65%6c%6f%70%65%72%73%68%61%72%69%66%2f%74%69%6e%79%67%72%61%6d%3c%2f%61%3e%27%3c%2f%73%70%61%6e%3e%2c%0d%0a%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%3c%2f%70%3e%0d%0a%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%3c%70%3e%26%6e%62%73%70%3b%26%6e%62%73%70%3b%26%6e%62%73%70%3b%26%6e%62%73%70%3b%41%75%74%68%6f%72%3a%20%3c%73%70%61%6e%20%63%6c%61%73%73%3d%22%74%65%78%74%2d%79%65%6c%6c%6f%77%2d%33%30%30%22%3e%27%3c%61%0d%0a%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%68%72%65%66%3d%22%68%74%74%70%73%3a%2f%2f%74%77%69%74%74%65%72%2e%63%6f%6d%2f%64%65%76%65%6c%6f%70%65%72%73%68%61%72%69%66%22%20%74%61%72%67%65%74%3d%22%5f%62%6c%61%6e%6b%22%0d%0a%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%63%6c%61%73%73%3d%22%74%65%78%74%2d%79%65%6c%6c%6f%77%2d%33%30%30%20%68%6f%76%65%72%3a%75%6e%64%65%72%6c%69%6e%65%20%66%6f%63%75%73%3a%62%6f%72%64%65%72%2d%6e%6f%6e%65%22%3e%68%74%74%70%73%3a%2f%2f%74%77%69%74%74%65%72%2e%63%6f%6d%2f%64%65%76%65%6c%6f%70%65%72%73%68%61%72%69%66%3c%2f%61%3e%27%3c%2f%73%70%61%6e%3e%2c%0d%0a%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%3c%2f%70%3e%0d%0a%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%3c%70%3e%26%6e%62%73%70%3b%26%6e%62%73%70%3b%7d%3c%2f%70%3e%0d%0a%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%3c%70%3e%7d%3c%2f%70%3e%0d%0a%20%20%20%20%20%20%20%20%20%20%20%20%3c%2f%64%69%76%3e%0d%0a%20%20%20%20%20%20%20%20%20%20%20%20%3c%64%69%76%20%63%6c%61%73%73%3d%22%66%6c%65%78%20%6a%75%73%74%69%66%79%2d%63%65%6e%74%65%72%20%6d%62%2d%33%22%3e%0d%0a%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%3c%61%20%68%72%65%66%3d%22%68%74%74%70%73%3a%2f%2f%77%77%77%2e%62%75%79%6d%65%61%63%6f%66%66%65%65%2e%63%6f%6d%2f%64%65%76%65%6c%6f%70%65%72%73%68%61%72%69%66%22%20%74%61%72%67%65%74%3d%22%5f%62%6c%61%6e%6b%22%3e%3c%69%6d%67%0d%0a%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%73%72%63%3d%22%68%74%74%70%73%3a%2f%2f%69%6d%67%2e%62%75%79%6d%65%61%63%6f%66%66%65%65%2e%63%6f%6d%2f%62%75%74%74%6f%6e%2d%61%70%69%2f%3f%74%65%78%74%3d%42%75%79%20%6d%65%20%61%20%63%6f%66%66%65%65%2e%26%65%6d%6f%6a%69%3d%2615%26%73%6c%75%67%3d%64%65%76%65%6c%6f%70%65%72%73%68%61%72%69%66%26%62%75%74%74%6f%6e%5f%63%6f%6c%6f%75%72%3d%46%46%44%44%30%30%26%66%6f%6e%74%5f%63%6f%6c%6f%75%72%3d%30%30%30%30%30%30%26%66%6f%6e%74%5f%66%61%6d%69%6c%79%3d%50%6f%70%70%69%6e%73%26%6f%75%74%6c%69%6e%65%5f%63%6f%6c%6f%75%72%3d%30%30%30%30%30%30%26%63%6f%66%66%65%65%5f%63%6f%6c%6f%75%72%3d%66%66%66%66%66%66%22%20%2f%3e%3c%2f%61%3e%0d%0a%20%20%20%20%20%20%20%20%20%20%20%20%3c%2f%64%69%76%3e%0d%0a%20%20%20%20%20%20%20%20%3c%2f%64%69%76%3e%0d%0a%0d%0a%20%20%20%20%3c%2f%64%69%76%3e'
        ));
    </script>
@endsection
