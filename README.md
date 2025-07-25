# Fletcher Framework

> **🚧 Alpha Version**: This framework is in early development. 
> API may change without notice. Use at your own risk.

Fletcher is a full-stack TALL framework built on Laravel/Livewire for rapid application development. It provides enhanced components and developer experience while maintaining full compatibility with the Laravel ecosystem.

## Installation

```bash
composer require fletcher/fletcher:dev-main
```

## Features

Fletcher Framework enhances the TALL stack development experience with:

- **x-wing Component**: Seamless Blade slot passing to Livewire components
- **Enhanced Developer Experience**: Simplified syntax and conventions
- **Laravel Ecosystem Compatible**: Built on Laravel/Livewire foundation
- **Rapid Development**: Accelerated TALL stack application building

## Usage

The `x-wing` component acts as a bridge between Blade templates and Livewire components, allowing you to use Blade-style slot syntax with Livewire components that normally don't support nested slots.

```blade
<x-wing component="components.my-livewire-component" title="Example" description="Demo">
    <x-slot:preview>
        <button class="btn btn-primary">Preview Button</button>
    </x-slot:preview>
    
    <x-slot:content>
        <p>Some content here</p>
    </x-slot:content>
</x-wing>
```

## How it Works

Fletcher automatically detects all named slots and passes them to your Livewire component as a `slots` property, while also forwarding any attributes as component properties.

Your Livewire component receives:
- All attributes as individual properties
- All slots as a `$slots` array property

## Example Livewire Component

```php
class MyLivewireComponent extends Component
{
    public $title;
    public $description;
    public $slots = [];
    
    public function render()
    {
        return view('livewire.my-component');
    }
}
```

```blade
<!-- livewire.my-component -->
<div class="card">
    <h2>{{ $title }}</h2>
    <p>{{ $description }}</p>
    
    <div class="preview">
        {!! $slots['preview'] ?? '' !!}
    </div>
    
    <div class="content">
        {!! $slots['content'] ?? '' !!}
    </div>
</div>
```

## Requirements

- PHP ^8.2
- Laravel ^11.0
- Livewire ^3.0

## License

MIT