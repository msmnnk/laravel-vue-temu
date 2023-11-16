<x-mail::message>
# An image was added

This is to let you know that an image was added to a product.

## Product info

Name: {{ $product->title }}

Number of images: {{ $product->images->count() }}

Description: {{ $product->description }}

<x-mail::button :url="route('products.show', $product)">
View product details
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
