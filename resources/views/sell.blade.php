@extends('layout')

@section('title', 'Új adatok eladása')

@section('styles')
<style>
    #description {
        resize: none;
        overflow: hidden;
        box-sizing: border-box;
    }

    #rows, #cols {
        -moz-appearance: textfield;
        appearance: textfield;
        -webkit-appearance: textfield;
    }
</style>
@endsection

@section('content')
<div class="row justify-content-center fade-in">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header py-3">
                <h4 class="mb-0">Új tábla eladása</h4>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('sell') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row mb-3">
                        <div class="col-md-8">
                            <label for="name" class="form-label">Tábla neve</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                   id="name" name="name" value="{{ old('name') }}" autocomplete="off" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="price" class="form-label">Ár (Ft)</label>
                            <input type="number" class="form-control @error('price') is-invalid @enderror"
                                   id="price" name="price" value="{{ old('price') }}" autocomplete="off" required>
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="description" class="form-label">Leírás</label>
                            <textarea class="form-control @error('description') is-invalid @enderror"
                                      id="description" name="description" data-autoresize rows="1"
                                      autocomplete="off" required>{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="rows" class="form-label">Sorok száma</label>
                            <input type="text" class="form-control @error('rows') is-invalid @enderror"
                                   id="rows" name="rows" value="{{ old('rows') }}" autocomplete="off"
                                   oninput="this.value = this.value.replace(/[^0-9]/g, '');" required>
                            @error('rows')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="cols" class="form-label">Oszlopok száma</label>
                            <input type="text" class="form-control @error('cols') is-invalid @enderror"
                                   id="cols" name="cols" value="{{ old('cols') }}" autocomplete="off"
                                   oninput="this.value = this.value.replace(/[^0-9]/g, '');" required>
                            @error('cols')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="image" class="form-label">Kép feltöltése</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror"
                                   id="image" name="image" accept="image/*" required>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12">
                            <h5>Oszlopok definíciója</h5>
                            <p class="text-muted small">Add meg az adatbázis oszlopainak nevét és típusát</p>

                            <div id="columns-container">
                                <div class="row mb-2 column-row">
                                    <div class="col-md-5">
                                        <input type="text" class="form-control" name="column_names[]"
                                               placeholder="Oszlop neve" required>
                                    </div>
                                    <div class="col-md-5">
                                        <select class="form-control" name="column_types[]" required>
                                            <option value="">-- Válassz típust --</option>
                                            <option value="VARCHAR(255)">VARCHAR(255) - Szöveg</option>
                                            <option value="INT">INT - Egész szám</option>
                                            <option value="DECIMAL(10,2)">DECIMAL(10,2) - Tizedes tört</option>
                                            <option value="DATE">DATE - Dátum</option>
                                            <option value="DATETIME">DATETIME - Dátum és idő</option>
                                            <option value="TEXT">TEXT - Hosszú szöveg</option>
                                            <option value="BOOLEAN">BOOLEAN - Igen/Nem</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-outline-danger remove-column" disabled>
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-2">
                                <button type="button" class="btn btn-outline-secondary" id="add-column" >
                                    <i class="fas fa-plus me-1"></i> Új oszlop hozzáadása
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="complete" name="complete">
                                <label class="form-check-label" for="complete">
                                    Az adatbázis teljes (nincsenek benne hiányzó adatok)
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Feltöltés</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script defer>
    document.addEventListener('DOMContentLoaded', function() {
        // Textarea magasságának kezelése
        const textarea = document.getElementById('description');
        if (textarea) {
            adjustHeight(textarea);

            textarea.addEventListener('input', function() {
                adjustHeight(this);
            });
        }

        // Az "Új oszlop hozzáadása" gomb eseménykezelője
        const addColumnBtn = document.getElementById('add-column');
        if (addColumnBtn) {
            addColumnBtn.addEventListener('click', addNewColumn);
        }

        // Delegált eseménykezelő az összes törlés gombhoz (akár meglévők, akár jövőbeliek)
        document.addEventListener('click', function(e) {
            const removeBtn = e.target.closest('.remove-column');
            if (removeBtn) {
                removeColumn(removeBtn);
            }
        });

        // Inicializálás
        updateRemoveButtons();
    });

    // Textarea magasság beállítása
    function adjustHeight(element) {
        element.style.height = 'auto';
        element.style.height = element.scrollHeight + 'px';
    }

    // Oszlop hozzáadása funkció
    function addNewColumn() {
        console.log('Új oszlop hozzáadása...');
        const columnsContainer = document.getElementById('columns-container');

        const newRow = document.createElement('div');
        newRow.className = 'row mb-2 column-row';
        newRow.innerHTML = `
            <div class="col-md-5">
                <input type="text" class="form-control" name="column_names[]" placeholder="Oszlop neve" required>
            </div>
            <div class="col-md-5">
                <select class="form-control" name="column_types[]" required>
                    <option value="">-- Válassz típust --</option>
                    <option value="VARCHAR(255)">VARCHAR(255) - Szöveg</option>
                    <option value="INT">INT - Egész szám</option>
                    <option value="DECIMAL(10,2)">DECIMAL(10,2) - Tizedes tört</option>
                    <option value="DATE">DATE - Dátum</option>
                    <option value="DATETIME">DATETIME - Dátum és idő</option>
                    <option value="TEXT">TEXT - Hosszú szöveg</option>
                    <option value="BOOLEAN">BOOLEAN - Igen/Nem</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-outline-danger remove-column">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        `;

        columnsContainer.appendChild(newRow);
        updateRemoveButtons();
    }

    // Oszlop törlése funkció
    function removeColumn(button) {
        console.log('Oszlop törlése...');
        const row = button.closest('.column-row');
        const rows = document.querySelectorAll('.column-row');

        if (rows.length > 1) {
            row.remove();
            updateRemoveButtons();
        }
    }

    // Törlés gombok állapotának frissítése
    function updateRemoveButtons() {
        const rows = document.querySelectorAll('.column-row');
        const removeButtons = document.querySelectorAll('.remove-column');

        console.log(`Sorok száma: ${rows.length}, Gombok száma: ${removeButtons.length}`);

        // Törlés gombok kezelése
        removeButtons.forEach(btn => {
            if (rows.length <= 1) {
                // Letiltás, ha csak egy sor van
                btn.setAttribute('disabled', 'disabled');
                btn.classList.add('disabled');
            } else {
                // Engedélyezés, ha több sor van
                btn.removeAttribute('disabled');
                btn.classList.remove('disabled');
            }
        });
    }
</script>
@endsection
