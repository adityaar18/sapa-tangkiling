<div>
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
            <x-sidebar.links title="Dashboard" route="dashboard" icon="icon-grid" />
            @if(auth()->user()->role === 'admin' || auth()->user()->role === 'lurah')
                <x-sidebar.links title="Surat" route="surat" icon="fa fa-envelope" />
                <x-sidebar.links title="Validasi Surat" route="lurah.validasi" icon="fa fa-envelope" />
            @endif
            @if(auth()->user()->role === 'rt' || auth()->user()->role === 'rw')
                <x-sidebar.links title="Surat" route="surat.rtrw" icon="fa fa-envelope" />
            @endif
            @if(auth()->user()->role === 'admin')
             <x-sidebar.links title="Jenis Surat" route="jenis_surat" icon="fa fa-file-text-o" />
             <x-sidebar.links title="Template Surat" route="template_surat" icon="fa fa-file-pdf-o" />
             <x-sidebar.links title="Nomor Surat" route="nomorsurat" icon="fa fa-hashtag" />
             <x-sidebar.links title="Bidang Surat" route="bidangsurat" icon="fa fa-envelope-open" /> 
             <x-sidebar.links title="Penandatangan" route="penandatangan" icon="fa fa-pencil-square-o" /> 
             <x-sidebar.links title="Jabatan" route="jabatan" icon="fa fa-id-badge" />
             @endif
        </ul>
    </nav>
</div>
