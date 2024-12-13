<link rel="stylesheet" href="<?= CSS; ?>/admin.css">
<body>
    <div class="table-container">
        <div class="table-header">
            <button class="btn-info" onclick="sortByName()">
                <i class="fas fa-filter"></i>
                Nama
            </button>
            <button class="btn-info" onclick="sortByUsername()">
                <i class="fas fa-filter"></i>
                Username
            </button>
            <button class="btn-info" onclick="sortByRole()">
                <i class="fas fa-filter"></i>
                Role
            </button>
            <button class="btn-info" onclick="sortByStatus()">
                <i class="fas fa-filter"></i>
                Status Visible
            </button>

            <div class="search-container col-8">
                <input type="text" id="search-input" placeholder="Search...">
                <button id="search-button">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Role</th>
                    <th>Status Visible</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['users'] as $user): ?>
                    <tr>
                        <td><?= htmlspecialchars($user['name']) ?></td>
                        <td><?= htmlspecialchars($user['username']) ?></td>
                        <td>
                            <span class="password-mask">••••••••</span>
                            <span class="password-text" style="display: none;"><?= htmlspecialchars($user['password']) ?></span>
                            <button class="btn-eye" onclick="togglePassword(this)">
                                <i class="fas fa-eye"></i>
                            </button>
                        </td>
                        <td><?= htmlspecialchars($user['role']) ?></td>
                        <td><?= $user['visible_users'] == 1 ? 'Akun Aktif' : 'Akun Tidak Aktif' ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

<script>
    // Toggle password visibility
    function togglePassword(button) {
        const passwordMask = button.parentElement.querySelector('.password-mask');
        const passwordText = button.parentElement.querySelector('.password-text');
        const icon = button.querySelector('i');

        if (passwordMask.style.display === 'none') {
            passwordMask.style.display = 'inline';
            passwordText.style.display = 'none';
            icon.className = 'fas fa-eye';
        } else {
            passwordMask.style.display = 'none';
            passwordText.style.display = 'inline';
            icon.className = 'fas fa-eye-slash';
        }
    }
    // Button sort
    function resetSortButtons(exceptButton) {
        const buttons = document.querySelectorAll('.btn-info');
        buttons.forEach(button => {
            if (button !== exceptButton) {
                button.removeAttribute('data-sort');
                const icon = button.querySelector('i');
                icon.className = 'fas fa-sort';
            }
        });
    }

    function sortByName() {
        const table = document.querySelector('table');
        const rows = Array.from(table.querySelectorAll('tbody tr'));
        const button = document.querySelector('button[onclick="sortByName()"]');
        const isAscending = button.getAttribute('data-sort') !== 'asc';

        resetSortButtons(button);
        button.setAttribute('data-sort', isAscending ? 'asc' : 'desc');
        updateSortIcon(button, isAscending);

        rows.sort((a, b) => {
            const nameA = a.cells[0].textContent.trim().toLowerCase();
            const nameB = b.cells[0].textContent.trim().toLowerCase();
            return isAscending ? nameA.localeCompare(nameB) : nameB.localeCompare(nameA);
        });

        const tbody = table.querySelector('tbody');
        tbody.innerHTML = '';
        rows.forEach(row => tbody.appendChild(row));
    }

    function sortByUsername() {
        const table = document.querySelector('table');
        const rows = Array.from(table.querySelectorAll('tbody tr'));
        const button = document.querySelector('button[onclick="sortByUsername()"]');
        const isAscending = button.getAttribute('data-sort') !== 'asc';

        resetSortButtons(button);
        button.setAttribute('data-sort', isAscending ? 'asc' : 'desc');
        updateSortIcon(button, isAscending);

        rows.sort((a, b) => {
            const usernameA = a.cells[1].textContent.trim().toLowerCase();
            const usernameB = b.cells[1].textContent.trim().toLowerCase();
            return isAscending ? usernameA.localeCompare(usernameB) : usernameB.localeCompare(usernameA);
        });

        const tbody = table.querySelector('tbody');
        tbody.innerHTML = '';
        rows.forEach(row => tbody.appendChild(row));
    }

    function sortByRole() {
        const table = document.querySelector('table');
        const rows = Array.from(table.querySelectorAll('tbody tr'));
        const button = document.querySelector('button[onclick="sortByRole()"]');
        const isAscending = button.getAttribute('data-sort') !== 'asc';

        resetSortButtons(button);
        button.setAttribute('data-sort', isAscending ? 'asc' : 'desc');
        updateSortIcon(button, isAscending);

        rows.sort((a, b) => {
            const roleA = a.cells[3].textContent.trim().toLowerCase();
            const roleB = b.cells[3].textContent.trim().toLowerCase();
            return isAscending ? roleA.localeCompare(roleB) : roleB.localeCompare(roleA);
        });

        const tbody = table.querySelector('tbody');
        tbody.innerHTML = '';
        rows.forEach(row => tbody.appendChild(row));
    }

    function sortByStatus() {
        const table = document.querySelector('table');
        const rows = Array.from(table.querySelectorAll('tbody tr'));
        const button = document.querySelector('button[onclick="sortByStatus()"]');
        const isAscending = button.getAttribute('data-sort') !== 'asc';

        resetSortButtons(button);
        button.setAttribute('data-sort', isAscending ? 'asc' : 'desc');
        updateSortIcon(button, isAscending);

        rows.sort((a, b) => {
            const statusA = a.cells[4].textContent.trim().toLowerCase();
            const statusB = b.cells[4].textContent.trim().toLowerCase();
            return isAscending ? statusA.localeCompare(statusB) : statusB.localeCompare(statusA);
        });

        const tbody = table.querySelector('tbody');
        tbody.innerHTML = '';
        rows.forEach(row => tbody.appendChild(row));
    }

    function updateSortIcon(button, isAscending) {
        const icon = button.querySelector('i');
        icon.className = isAscending ? 'fas fa-sort-up' : 'fas fa-sort-down';
    }

    // Update the button HTML to include sort icons
    document.addEventListener('DOMContentLoaded', function() {
        const buttons = document.querySelectorAll('.btn-info');
        buttons.forEach(button => {
            const icon = button.querySelector('i');
            icon.className = 'fas fa-sort';
        });
    });

    $(document).ready(function() {
        // Existing search functionality
        $('#search-button').click(function() {
            var searchValue = $('#search-input').val().toLowerCase();
            filterTable(searchValue, null);
        });

        $('#search-input').on('keyup', function() {
            var searchValue = $(this).val().toLowerCase();
            filterTable(searchValue, null);
        });

        // Helper function to filter table
        function filterTable(searchValue, status) {
            $('tbody tr').hide();
            $('tbody tr').filter(function() {
                var text = $(this).text().toLowerCase();
                return text.indexOf(searchValue) > -1;
            }).show();
        }
    });
</script>