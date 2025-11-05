@props([
    'name' => 'rating',
    'value' => 0,
    'readonly' => false,
    'size' => 'lg'
])

@php
    $sizeClasses = [
        'sm' => 'text-lg',
        'md' => 'text-2xl',
        'lg' => 'text-4xl',
    ];
    $sizeClass = $sizeClasses[$size] ?? $sizeClasses['lg'];
@endphp

<div class="star-rating {{ $sizeClass }}" 
     data-rating="{{ $value }}"
     data-readonly="{{ $readonly ? 'true' : 'false' }}">
    
    <input type="hidden" name="{{ $name }}" value="{{ $value }}" class="rating-input">
    
    <div class="flex gap-1">
        @for ($i = 1; $i <= 5; $i++)
            <button 
                type="button"
                class="star-btn transition-all duration-200"
                data-value="{{ $i }}"
                @if($readonly) disabled @endif
                style="cursor: {{ $readonly ? 'default' : 'pointer' }}">
                <span class="star {{ $i <= $value ? 'filled' : 'empty' }}">★</span>
            </button>
        @endfor
    </div>
    
    <p class="text-sm text-orange-600 mt-2">
        <span class="rating-text">
            @if($value == 0)
                Sin calificación
            @else
                {{ $value }} de 5 estrellas
            @endif
        </span>
    </p>
</div>

<style>
    .star-rating {
        display: inline-block;
    }
    
    .star-btn {
        background: none;
        border: none;
        padding: 0;
        margin: 0;
        transition: transform 0.2s;
    }
    
    .star-btn:hover:not(:disabled) {
        transform: scale(1.2);
    }
    
    .star-btn:disabled {
        cursor: default !important;
    }
    
    .star {
        transition: color 0.2s;
        display: inline-block;
    }
    
    .star.filled {
        color: #fbbf24;
        text-shadow: 0 0 2px rgba(251, 191, 36, 0.5);
    }
    
    .star.empty {
        color: #d1d5db;
    }
</style>

<script>
    document.querySelectorAll('.star-rating').forEach(rating => {
        const isReadonly = rating.getAttribute('data-readonly') === 'true';
        const input = rating.querySelector('.rating-input');
        const buttons = rating.querySelectorAll('.star-btn');
        const ratingText = rating.querySelector('.rating-text');
        
        buttons.forEach(btn => {
            btn.addEventListener('click', (e) => {
                if (isReadonly) return;
                
                e.preventDefault();
                const value = btn.getAttribute('data-value');
                input.value = value;
                
                buttons.forEach((b, idx) => {
                    const star = b.querySelector('.star');
                    if ((idx + 1) <= value) {
                        star.classList.remove('empty');
                        star.classList.add('filled');
                    } else {
                        star.classList.remove('filled');
                        star.classList.add('empty');
                    }
                });
                
                ratingText.textContent = value + ' de 5 estrellas';
            });
            
            btn.addEventListener('mouseenter', (e) => {
                if (isReadonly) return;
                
                const hoverValue = btn.getAttribute('data-value');
                buttons.forEach((b, idx) => {
                    const star = b.querySelector('.star');
                    if ((idx + 1) <= hoverValue) {
                        star.style.opacity = '0.7';
                    } else {
                        star.style.opacity = '1';
                    }
                });
            });
        });
        
        rating.addEventListener('mouseleave', () => {
            buttons.forEach(btn => {
                const star = btn.querySelector('.star');
                star.style.opacity = '1';
            });
        });
    });
</script>