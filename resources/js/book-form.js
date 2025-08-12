document.addEventListener('DOMContentLoaded', function() {
    const isbnInput = document.getElementById('isbn');
    const apiFeedback = document.createElement('div');
    apiFeedback.className = 'alert mt-2';
    isbnInput.insertAdjacentElement('afterend', apiFeedback);

    isbnInput.addEventListener('blur', async function() {
        const isbn = this.value.trim().replace(/-/g, '');
        
        // Validação do ISBN
        if (!isbn || isbn.length < 10) {
            apiFeedback.textContent = 'ISBN inválido (mínimo 10 caracteres)';
            apiFeedback.className = 'alert alert-warning mt-2';
            return;
        }

        // Feedback visual
        apiFeedback.textContent = 'Buscando dados na Google Books API...';
        apiFeedback.className = 'alert alert-info mt-2';
        
        const coverPreview = document.querySelector('.cover-preview');
        coverPreview.innerHTML = '<div class="text-center py-3"><div class="spinner-border text-primary"></div></div>';

        try {
            const response = await fetch("{{ route('books.fetch-data') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ isbn })
            });

            const data = await response.json();
            
            if (!data.success) {
                throw new Error(data.message || 'Livro não encontrado na Google Books API');
            }

            // Preenchimento automático dos campos
            const fields = {
                'title': data.data.title || '',
                'author': data.data.author || '',
                'publisher': data.data.publisher || '',
                'description': data.data.description || '',
                'image_url': data.data.cover || ''
            };

            Object.entries(fields).forEach(([name, value]) => {
                const field = document.querySelector(`[name="${name}"]`);
                if (field) field.value = value;
            });

            // Tratamento especial para o ano
            if (data.data.year) {
                const yearMatch = data.data.year.match(/\d{4}/);
                if (yearMatch) {
                    document.querySelector('[name="year"]').value = yearMatch[0];
                }
            }

            // Atualização da capa do livro
            if (data.data.cover) {
                coverPreview.innerHTML = `
                    <img src="${data.data.cover}" 
                         class="img-thumbnail" 
                         style="max-height:200px;"
                         alt="Capa do livro ${data.data.title || ''}">
                    <small class="d-block mt-1 text-center">Capa automática</small>
                `;
            } else {
                coverPreview.innerHTML = `
                    <div class="text-muted py-4 bg-light text-center">
                        <i class="bi bi-book" style="font-size:2rem"></i>
                        <p class="mt-2">Capa não disponível</p>
                    </div>
                `;
            }

            apiFeedback.textContent = 'Dados carregados com sucesso!';
            apiFeedback.className = 'alert alert-success mt-2';

        } catch (error) {
            console.error('Erro na API:', error);
            coverPreview.innerHTML = `
                <div class="alert alert-warning text-center py-3">
                    <i class="bi bi-exclamation-triangle"></i>
                    <p class="mt-2">${error.message || 'Erro ao buscar dados'}</p>
                    <small>Preencha os campos manualmente</small>
                </div>
            `;
            apiFeedback.textContent = error.message;
            apiFeedback.className = 'alert alert-danger mt-2';
        }
    });

    // Limpa o feedback quando o usuário começa a digitar
    isbnInput.addEventListener('input', function() {
        apiFeedback.textContent = '';
        apiFeedback.className = 'alert mt-2';
    });
});