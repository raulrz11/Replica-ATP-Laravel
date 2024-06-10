<?php

use App\Models\Tenista;
use App\Models\Torneo;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class TorneosControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $tenistas;
    protected $torneos;
    protected User $user;
    protected User $admin;

    public function setUp(): void
    {
        parent::setUp();

        $this->tenistas = Tenista::factory()->count(3)->create();
        $this->torneos = Torneo::factory()->count(3)->create();
        $this->user = User::factory()->create();
        $this->admin = User::factory()->create(['rol' => 'ADMIN']);
    }

    public function testIndex(){
        $response = $this->get(route('torneos.index'));
        $response->assertStatus(200);
    }

    public function testShow(){
        $response = $this->get(route('torneos.show', $this->torneos[0]->id));

        $response->assertStatus(200);
        $response->assertViewIs('torneos.show');
    }

    public function testShowInvalidId(){
        $invalidId = Str::uuid();

        $response = $this->get(route('torneos.show', $invalidId));

        $response->assertStatus(404);
    }

    public function testCreateForbidden()
    {
        $this->actingAs($this->user);

        $response = $this->get(route('torneos.create'));
        $response->assertRedirect(route('login'));
    }

    public function testCreateAccessForm()
    {
        $this->actingAs($this->admin);

        $response = $this->get(route('torneos.create'));
        $response->assertStatus(200);
    }

    public function testStore(){
        $this->actingAs($this->admin);

        $data = [
            'id' => Str::uuid(),
            'nombre' => 'Mutua Open',
            'ubicacion' => 'Colombia, Bogota',
            'modalidad' => 'INDIVIDUALES/DOBLES',
            'categoria' => 'MASTER_250',
            'superficie' => 'ASFALTO',
            'entradas' => 4,
            'premio' => 1500000,
            'fecha_inicio' => '2024-05-27',
            'fecha_finalizacion' => '2024-06-09',
            'imagen' => 'https://mutuamadridopen.com/filters/img/estadio-1.6affd27c.jpg',
        ];

        $response = $this->post(route('torneos.store'), $data);
        $response->assertRedirect('/');//la ruta deberia ser tenistas.index
    }

    public function testEditForbidden()
    {
        $this->actingAs($this->user);

        $response = $this->get(route('torneos.edit', $this->torneos[0]->id));
        $response->assertRedirect(route('login'));
    }

    public function testEditAccessForm()
    {
        $this->actingAs($this->admin);

        $response = $this->get(route('torneos.edit', $this->torneos[0]->id));
        $response->assertStatus(200);
    }

    public function testEditInvalidId(){
        $invalidId = Str::uuid();

        $this->actingAs($this->admin);

        $response = $this->get(route('torneos.edit', $invalidId));

        $response->assertStatus(404);
    }

    public function testUpdate(){
        $this->actingAs($this->admin);

        $torneo = Torneo::factory()->create([
            'id' => Str::uuid(),
            'nombre' => 'Mutua Open',
            'ubicacion' => 'Colombia, Bogota',
            'modalidad' => 'INDIVIDUALES/DOBLES',
            'categoria' => 'MASTER_250',
            'superficie' => 'ASFALTO',
            'entradas' => 4,
            'premio' => 1500000,
            'fecha_inicio' => '2024-05-27',
            'fecha_finalizacion' => '2024-06-09',
            'imagen' => 'https://mutuamadridopen.com/filters/img/estadio-1.6affd27c.jpg',
        ]);

        $data = [
            'nombre' => 'Mutua Open',
            'ubicacion' => 'Colombia, Bogota',
            'modalidad' => 'INDIVIDUALES/DOBLES',
            'categoria' => 'MASTER_250',
            'superficie' => 'ASFALTO',
            'entradas' => 4,
            'premio' => 1500000,
            'fecha_inicio' => '2024-05-27',
            'fecha_finalizacion' => '2024-06-09',
            'imagen' => 'https://mutuamadridopen.com/filters/img/estadio-1.6affd27c.jpg',
        ];

        $response = $this->put(route('torneos.update', $torneo->id), $data);
        $response->assertRedirect('/');//la ruta deberia ser tenistas.index
        $this->assertDatabaseHas('torneos', $data);
    }

    public function testEditImageForbidden()
    {
        $this->actingAs($this->user);

        $response = $this->get(route('torneos.image', $this->torneos[0]->id));
        $response->assertRedirect(route('login'));
    }

    public function testEditImageAccessForm()
    {
        $this->actingAs($this->admin);

        $response = $this->get(route('torneos.image', $this->torneos[0]->id));

        $response->assertStatus(200);
    }

    public function testEditImageInvalidId(){
        $invalidId = Str::uuid();

        $this->actingAs($this->admin);

        $response = $this->get(route('torneos.image', $invalidId));

        $response->assertStatus(404);
    }

    public function testDeleteForbidden()
    {
        $this->actingAs($this->user);

        $response = $this->delete(route('torneos.destroy', $this->torneos[0]->id));
        $response->assertRedirect(route('login'));
    }

    public function testDelete()
    {
        $this->actingAs($this->admin);

        $response = $this->delete(route('torneos.destroy', $this->torneos[0]->id));

        $this->assertDatabaseMissing('torneos', ['id' => "67fd6576-2448-4367-a3b7-66290f22f853"]);

        $response->assertRedirect(route('torneos.index'));
    }

    public function testDeleteInvalidId(){
        $invalidId = Str::uuid();

        $this->actingAs($this->admin);

        $response = $this->get(route('torneos.destroy', $invalidId));

        $response->assertStatus(404);
    }




    public function testInscribirTenistaForbidden()
    {
        $this->actingAs($this->user);

        $response = $this->delete(route('torneos.inscribirTenista', $this->torneos[0]->id));
        $response->assertRedirect(route('login'));
    }

    public function testInscribirTenistaSinNombre()
    {
        $this->actingAs($this->admin);

        $torneo = Torneo::factory()->create();

        $response = $this->postJson("/torneos/{$torneo->id}", []);

        $response->assertStatus(400);
        $response->assertJsonStructure(['errors' => ['nombre']]);
    }

    public function testTenistaYaInscrito()
    {
        $this->actingAs($this->admin);

        $torneo = Torneo::factory()->create();
        $tenista = Tenista::factory()->create();
        $torneo->tenistas()->attach($tenista);

        $response = $this->postJson("/torneos/{$torneo->id}", [
            'nombre' => $tenista->nombre
        ]);

        $response->assertRedirect(route('torneos.show', $torneo->id));
        $response->assertSessionHas('error', 'El tenista ya está inscrito al torneo');
    }

    public function testNoHayVacantes()
    {
        $this->actingAs($this->admin);

        $torneo = Torneo::factory()->create(['entradas' => 0]);
        $tenista = Tenista::factory()->create();

        $response = $this->postJson("/torneos/{$torneo->id}", [
            'nombre' => $tenista->nombre
        ]);

        $response->assertRedirect(route('torneos.show', $torneo->id));
        $response->assertSessionHas('error', 'No quedan vacantes para este torneo');
    }

    public function testInscribirTenista()
    {
        $this->actingAs($this->admin);

        $torneo = Torneo::factory()->create(['entradas' => 1]);
        $tenista = Tenista::factory()->create();

        $response = $this->postJson("/torneos/{$torneo->id}", [
            'nombre' => $tenista->nombre
        ]);

        $this->assertDatabaseHas('tenista_torneo', [
            'torneo_secondary_id' => $torneo->secondary_id,
            'tenista_id' => $tenista->id
        ]);

        $torneo->refresh();
        $this->assertEquals(0, $torneo->entradas);

        $response->assertRedirect();
    }

    public function testFinalizarTorneo()
    {
        $this->actingAs($this->admin);

        $torneo = Torneo::factory()->create([
            'categoria' => 'MASTER_1000',
            'premio' => 10000,
        ]);

        $tenista1 = Tenista::factory()->create(['puntos' => 0, 'price_money' => 0, 'altura' => 195]);
        $tenista2 = Tenista::factory()->create(['puntos' => 0, 'price_money' => 0, 'altura' => 185]);
        $tenista3 = Tenista::factory()->create(['puntos' => 0, 'price_money' => 0, 'altura' => 175]);
        $tenista4 = Tenista::factory()->create(['puntos' => 0, 'price_money' => 0,'altura' => 165]);
        $tenista5 = Tenista::factory()->create(['puntos' => 0, 'price_money' => 0,'altura' => 155]);

        $torneo->tenistas()->attach([$tenista1->id, $tenista2->id, $tenista3->id, $tenista4->id, $tenista5->id]);

        $response = $this->delete(route('torneos.finalizarTorneo', $torneo->id));

        $response->assertRedirect(route('torneos.index'));

        $this->assertSoftDeleted($torneo);
    }
}
