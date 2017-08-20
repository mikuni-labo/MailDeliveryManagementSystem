<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <ol class="breadcrumb">
            <?php $i = 1; ?>
            @foreach( $breadcrumb as $key => $val )
                @unless( $i === count($breadcrumb) )
                    <li><a href="{{ $val }}">{{ $key }}</a></li>
                @else
                    <li class="active">{{ $key }}</li>
                @endunless
                <?php $i++; ?>
            @endforeach
        </ol>
    </div>
</div>
