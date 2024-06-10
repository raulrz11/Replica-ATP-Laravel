<?php

use App\Models\Tenista;
use App\Models\Torneo;
use App\Models\User;
use App\Http\Controllers\TenistasController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tests\TestCase;

class TenistasControllerTest extends TestCase
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
        $response = $this->get(route('tenistas.index'));
        $response->assertStatus(200);
    }

    public function testShow(){
        $response = $this->get(route('tenistas.show', $this->tenistas[0]->id));

        $response->assertStatus(200);
        $response->assertViewIs('tenistas.show');
    }

    public function testShowInvalidId(){
        $invalidId = 99;

        $response = $this->get(route('tenistas.show', $invalidId));

        $response->assertStatus(404);
    }

    public function testCreateForbidden()
    {
        $this->actingAs($this->user);

        $response = $this->get(route('tenistas.create'));
        $response->assertRedirect(route('login'));
    }

    public function testCreateAccessForm()
    {
        $this->actingAs($this->admin);

        $response = $this->get(route('tenistas.create'));
        $response->assertStatus(200);
    }

    public function testStore(){
        $this->actingAs($this->admin);

        $data = [
            'nombre' => 'Raul',
            'puntos' => 2,
            'pais' => 'España',
            'fecha_nacimiento' => '1986-06-03',
            'edad' => 37,
            'altura' => 180,
            'peso' => 70,
            'inicio_profesional' => '2001-04-29',
            'mano_buena' => 'IZQUIERDA',
            'reves' => 'UNA_MANO',
            'entrenador' => 'Carlos Moya',
            'imagen' => 'https://cdn-icons-png.flaticon.com/512/4725/4725937.png',
            'price_money' => 1000,
            'victorias' => 5,
            'derrotas' => 2,
        ];

        $response = $this->post(route('tenistas.store'), $data);
        $response->assertRedirect('/');//la ruta deberia ser tenistas.index
    }

    public function testEditForbidden()
    {
        $this->actingAs($this->user);

        $response = $this->get(route('tenistas.edit', $this->tenistas[0]->id));
        $response->assertRedirect(route('login'));
    }

    public function testEditAccessForm()
    {
        $this->actingAs($this->admin);

        $response = $this->get(route('tenistas.edit', $this->tenistas[0]->id));
        $response->assertStatus(200);
    }

    public function testEditInvalidId(){
        $invalidId = 99;

        $this->actingAs($this->admin);

        $response = $this->get(route('tenistas.edit', $invalidId));

        $response->assertStatus(404);
    }

    public function testUpdate(){
        $this->actingAs($this->admin);

        $tenista = Tenista::factory()->create([
            'id' => 1,
            'nombre' => 'Raul',
            'puntos' => 2,
            'pais' => 'España',
            'fecha_nacimiento' => '1986-06-03',
            'edad' => 37,
            'altura' => 180,
            'peso' => 70,
            'inicio_profesional' => '2001-04-29',
            'mano_buena' => 'IZQUIERDA',
            'reves' => 'UNA_MANO',
            'entrenador' => 'Carlos Moya',
            'imagen' => 'https://cdn-icons-png.flaticon.com/512/4725/4725937.png',
            'price_money' => 1000,
            'victorias' => 5,
            'derrotas' => 2,
        ]);

        $data = [
            'nombre' => 'Raul',
            'puntos' => 2,
            'pais' => 'España',
            'fecha_nacimiento' => '1986-06-03',
            'edad' => 37,
            'altura' => 180,
            'peso' => 70,
            'inicio_profesional' => '2001-04-29',
            'mano_buena' => 'IZQUIERDA',
            'reves' => 'UNA_MANO',
            'entrenador' => 'Carlos Moya',
            'imagen' => 'https://cdn-icons-png.flaticon.com/512/4725/4725937.png',
            'price_money' => 1000,
            'victorias' => 5,
            'derrotas' => 2,
        ];

        $response = $this->put(route('tenistas.update', $tenista->id), $data);
        $response->assertRedirect('/');//la ruta deberia ser tenistas.index
        $this->assertDatabaseHas('tenistas', $data);
    }

    public function testEditImageForbidden()
    {
        $this->actingAs($this->user);

        $response = $this->get(route('tenistas.image', $this->tenistas[0]->id));
        $response->assertRedirect(route('login'));
    }

    public function testEditImageAccessForm()
    {
        $this->actingAs($this->admin);

        $response = $this->get(route('tenistas.image', $this->tenistas[0]->id));

        $response->assertStatus(200);
    }

    public function testEditImageInvalidId(){
        $invalidId = 99;

        $this->actingAs($this->admin);

        $response = $this->get(route('tenistas.image', $invalidId));

        $response->assertStatus(404);
    }

    public function testDeleteForbidden()
    {
        $this->actingAs($this->user);

        $response = $this->delete(route('tenistas.destroy', $this->tenistas[0]->id));
        $response->assertRedirect(route('login'));
    }

    public function testDelete()
    {
        $this->actingAs($this->admin);

        $response = $this->delete(route('tenistas.destroy', $this->tenistas[0]->id));

        $this->assertDatabaseMissing('tenistas', ['id' => $this->tenistas[0]->id]);

        $response->assertRedirect(route('tenistas.index'));
    }

    public function testDeleteInvalidId(){
        $invalidId = 99;

        $this->actingAs($this->admin);

        $response = $this->get(route('tenistas.destroy', $invalidId));

        $response->assertStatus(404);
    }

    public function testPorcentajes(){
        $tenista = Tenista::factory()->create(['victorias' => 5, 'derrotas' => 3]);

        $controller = new TenistasController();

        $controller->porcentajesVictoriasDerrotas();

        $tenista->refresh();

        $this->assertEquals('62.50% / 37.50%', $tenista->win_lose);
    }

    public function testPdf()
    {
        $response = $this->get(route('tenistas.pdf', $this->tenistas[0]->id));

        $response->assertStatus(302); // Asegúrate de que la respuesta sea exitosa
        $response->assertHeader('Content-Type', 'text/html; charset=utf-8');
    }
}
