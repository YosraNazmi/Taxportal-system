@extends('Taxpayer.AnnualTaxForm')

@section('anouncements')
<style>
     .stepss {
            list-style: none;
            padding: 0;
            counter-reset: step-counter;
        }
        .stepss li {
            counter-increment: step-counter;
            margin-bottom: 20px;
            position: relative;
            padding-left: 60px;
        }
        .stepss li::before {
            content: counter(step-counter);
            display: inline-block;
            width: 1.75em;
            height: 1.75em;
            border-radius: 50%;
            background-color:#1e3e54;
            color: #fff;
            text-align: center;
            line-height: 1.75em;
            font-size: 80%;
            font-weight: bold;
            position: absolute;
            left: 0;
            top: .2em;
        }
        .stepss a {
            text-decoration: underline;
            color: inherit;
        }
        .ancher a{
            text-decoration: underline;
        }
</style>
<div class="container mt-5" style="padding-left: 5rem;">
    <h1 class="mb-4">Anouncments</h1>
    <p>You must pay Annual Tax on profits from doing business as:</p>
    <ul class="ancher">
        <li>a limited company</li>
        <li>any foreign company with a UK branch or office</li>
        <li>a club, co-operative or other <a href="#">unincorporated association</a>, for example a community group or sports club</li>
    </ul>
    <p>You do not get a bill for Corporation Tax. There are specific things you must do to work out, pay and report your tax.</p>
    <ol class="stepss" >
        <li  >
            <p>
                Make Sure you fill all<a href=""> Appendixes from 1 to 27</a>
            </p>
        </li>
        <li>
            <p>
                Then fill the <a href="">Corporate income tax  and (Appendix 3) </a>
            </p>
        </li>
        <li>
            <p>
                Then fill the <a href="">Corporate income tax  and (Appendix 3) </a>
            </p>
        </li>
        <li>
            <p>
                Then fill the <a href="">Corporate income tax  and (Appendix 3) </a>
            </p>
        </li>
        <li>
            <p>
                Then fill the <a href="">Corporate income tax  and (Appendix 3) </a>
            </p>
        </li>
    </ol>
    
</div>
@endsection