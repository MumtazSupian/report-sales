@extends('layouts.app')

@section('title', 'Main Dashboard')

@section('content')
<div class="main-content">
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon">🎯</div>
            <div class="stat-label">Total Modules</div>
            <div class="stat-value">6</div>
            <div class="stat-trend">↗ All Active</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">🚗</div>
            <div class="stat-label">Units Sold</div>
            <div class="stat-value">142</div>
            <div class="stat-trend">↗ +12% vs last month</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">👥</div>
            <div class="stat-label">Sales Team</div>
            <div class="stat-value">24</div>
            <div class="stat-trend">↗ Active</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">💰</div>
            <div class="stat-label">Revenue Target</div>
            <div class="stat-value">87%</div>
            <div class="stat-trend">↗ On Track</div>
        </div>
    </div>

    <div class="welcome-card">
        <div class="welcome-header">
            <div class="welcome-icon">🏢</div>
            <h3>Dashboard Utama Suzuki</h3>
        </div>
        <p>
            Selamat datang di Sistem Manajemen Dealer Suzuki. Platform terpadu untuk mengelola seluruh aspek operasional dealer.
            Klik menu <b>RKA</b> untuk masuk ke modul Rencana Kerja & Anggaran.
        </p>
        
        <div class="quick-actions">
            <h3>Quick Actions</h3>
            <div class="actions-grid">
                <a href="{{ url('rka/dashboard') }}" class="action-btn">
                    <span class="action-btn-icon">📊</span> <span>Open RKA Module</span>
                </a>
                <a href="{{ route('activity.index') }}" class="action-btn">
                    <span class="action-btn-icon">📅</span> <span>Activity Plan</span>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection