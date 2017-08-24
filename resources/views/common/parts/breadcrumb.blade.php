<div class="row">
    <div class="col-md-{{ $width }} col-md-offset-{{ $offset }}">
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
