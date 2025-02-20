<x-head> 
</x-head>
<x-navbar/>
<x-sidebar/>
            <main>
                {{ $slot }}
            </main>
        </div>


        <script>
            document.addEventListener('DOMContentLoaded', function () {
                document.querySelectorAll('input[maxlength]').forEach(input => {
                    input.addEventListener('input', function () {
                        let errorSpan = document.getElementById(`error-${this.name}`);
            
                        if (this.value.length >= this.maxLength) {
                            errorSpan.textContent = `Maximum ${this.maxLength} characters allowed.`;
                        } else {
                            errorSpan.textContent = ''; // Clear the error message when valid
                        }
                    });
                });
            });
        </script>
            
        
    </body>
</html>
