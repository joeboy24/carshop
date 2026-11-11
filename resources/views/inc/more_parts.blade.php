@php
    $folderUrls = [];
    $partDir = storage_path('app/public/classified/maca-parts');
    if (is_dir($partDir)) {
        foreach (scandir($partDir) as $partFile) {
            if (preg_match('/\.(jpe?g|png|webp|gif)$/i', $partFile)) {
                $folderUrls[] = '/storage/classified/maca-parts/'.rawurlencode($partFile);
            }
        }
        sort($folderUrls, SORT_NATURAL);
    }

    $catalog = [];
    foreach ($parts as $part) {
        $photos = [];
        foreach ($part->gallery as $image) {
            if ($image->img) {
                $photos[] = \App\Support\Media::url('classified/cars/'.$part->stock_id.'/'.$image->img);
            }
        }
        $rawPrice = trim((string) $part->price);
        $priceLabel = '';
        if ($rawPrice !== '' && $rawPrice !== '-' && $rawPrice !== '0') {
            $priceLabel = is_numeric($rawPrice) ? 'USD '.number_format((float) $rawPrice) : $rawPrice;
        }
        $catalog[] = [
            'name' => $part->vwidth ?: 'Part',
            'price' => $priceLabel,
            'note' => trim((string) $part->max_load),
            'photos' => array_values(array_filter($photos)),
        ];
    }
@endphp

<div class="home_head">
    <h2>Shop vehicle parts</h2>
</div>

@if (count($catalog) > 0)
    <div class="vehicle_grid parts_catalog">
        @foreach ($catalog as $index => $item)
            <button type="button" class="vehicle_card part_item" data-part="{{ $index }}" @if (!count($item['photos'])) disabled @endif>
                <span class="vehicle_card_photo">
                    @if (count($item['photos']))
                        <img src="{{ $item['photos'][0] }}" alt="">
                    @endif
                </span>
                <span class="vehicle_card_name">{{ $item['name'] }}</span>
                @if ($item['price'] !== '')
                    <span class="vehicle_card_price">Price <strong>{{ $item['price'] }}</strong></span>
                @endif
                @if ($item['note'] !== '')
                    <span class="part_card_note">{{ $item['note'] }}</span>
                @endif
            </button>
        @endforeach
    </div>

    @if (method_exists($parts, 'hasPages') && $parts->hasPages())
        <div class="parts_pages">
            @if ($parts->onFirstPage())
                <span>Previous</span>
            @else
                <a href="{{ $parts->previousPageUrl() }}">Previous</a>
            @endif
            <span>{{ $parts->currentPage() }} / {{ $parts->lastPage() }}</span>
            @if ($parts->hasMorePages())
                <a href="{{ $parts->nextPageUrl() }}">Next</a>
            @else
                <span>Next</span>
            @endif
        </div>
    @endif

    <div class="part_modal" id="part_modal" hidden>
        <div class="part_modal_backdrop" data-part-close></div>
        <div class="part_modal_panel" role="dialog" aria-modal="true" aria-label="Part">
            <button type="button" class="part_modal_close" data-part-close aria-label="Close">&times;</button>
            <img class="part_modal_photo" alt="">
            <div class="part_modal_copy">
                <strong class="part_modal_name"></strong>
                <span class="part_modal_price"></span>
                <p class="part_modal_note"></p>
            </div>
            <div class="part_modal_thumbs"></div>
        </div>
    </div>
    <script type="application/json" id="part_catalog">@json($catalog)</script>
    <script type="application/json" id="part_folder">@json($folderUrls)</script>
    <script>
        (function () {
            var catalog = JSON.parse(document.getElementById('part_catalog').textContent);
            var folder = JSON.parse(document.getElementById('part_folder').textContent);
            var modal = document.getElementById('part_modal');
            var main = modal.querySelector('.part_modal_photo');
            var nameEl = modal.querySelector('.part_modal_name');
            var priceEl = modal.querySelector('.part_modal_price');
            var noteEl = modal.querySelector('.part_modal_note');
            var thumbs = modal.querySelector('.part_modal_thumbs');

            function seed(str) {
                var h = 2166136261;
                for (var i = 0; i < str.length; i++) {
                    h ^= str.charCodeAt(i);
                    h = Math.imul(h, 16777619);
                }
                return h >>> 0;
            }

            function shuffle(list, key) {
                var state = seed(key) || 1;
                function rand() {
                    state = (state + 0x6D2B79F5) | 0;
                    var t = Math.imul(state ^ (state >>> 15), 1 | state);
                    t = (t + Math.imul(t ^ (t >>> 7), 61 | t)) ^ t;
                    return ((t ^ (t >>> 14)) >>> 0) / 4294967296;
                }
                for (var i = list.length - 1; i > 0; i--) {
                    var j = Math.floor(rand() * (i + 1));
                    var swap = list[i];
                    list[i] = list[j];
                    list[j] = swap;
                }
                return list;
            }

            function photoSet(item) {
                var set = item.photos.slice();
                if (set.length >= 5 || !folder.length) return set.slice(0, 5);
                var pool = folder.filter(function (url) { return set.indexOf(url) === -1; });
                shuffle(pool, item.name + '|' + (set[0] || ''));
                while (set.length < 5 && pool.length) set.push(pool.shift());
                return set;
            }

            function show(url) {
                main.src = url;
                [].forEach.call(thumbs.children, function (button) {
                    button.classList.toggle('is_on', button.getAttribute('data-part') === url);
                });
            }

            function open(item) {
                if (!item.photos.length) return;
                var set = photoSet(item);
                thumbs.innerHTML = '';
                set.forEach(function (url) {
                    var button = document.createElement('button');
                    button.type = 'button';
                    button.setAttribute('data-part', url);
                    var img = document.createElement('img');
                    img.src = url;
                    img.alt = '';
                    button.appendChild(img);
                    button.addEventListener('click', function () { show(url); });
                    thumbs.appendChild(button);
                });
                nameEl.textContent = item.name;
                priceEl.textContent = '';
                if (item.price) {
                    priceEl.appendChild(document.createTextNode('Price '));
                    var amount = document.createElement('strong');
                    amount.textContent = item.price;
                    priceEl.appendChild(amount);
                }
                noteEl.textContent = item.note || '';
                noteEl.hidden = !item.note;
                thumbs.hidden = set.length < 2;
                show(set[0]);
                modal.hidden = false;
                document.body.classList.add('part_modal_open');
            }

            function close() {
                modal.hidden = true;
                main.removeAttribute('src');
                document.body.classList.remove('part_modal_open');
            }

            document.querySelectorAll('.part_item').forEach(function (card) {
                card.addEventListener('click', function () {
                    open(catalog[Number(card.getAttribute('data-part'))]);
                });
            });
            modal.querySelectorAll('[data-part-close]').forEach(function (el) {
                el.addEventListener('click', close);
            });
            document.addEventListener('keydown', function (event) {
                if (event.key === 'Escape' && !modal.hidden) close();
            });
        })();
    </script>
@else
    <p class="home_empty">No parts listed right now.</p>
@endif
