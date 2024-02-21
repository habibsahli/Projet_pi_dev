<?php

namespace App\Test\Controller;

use App\Entity\Packpersonnalise;
use App\Repository\PackpersonnaliseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PackpersonnaliseControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private PackpersonnaliseRepository $repository;
    private string $path = '/packpersonnalise/';
    private EntityManagerInterface $manager;

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::getContainer()->get('doctrine')->getRepository(Packpersonnalise::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Packpersonnalise index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $originalNumObjectsInRepository = count($this->repository->findAll());

        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'packpersonnalise[Nom_packperso]' => 'Testing',
            'packpersonnalise[type_pack]' => 'Testing',
            'packpersonnalise[Description_pack]' => 'Testing',
            'packpersonnalise[Prix]' => 'Testing',
            'packpersonnalise[Date]' => 'Testing',
            'packpersonnalise[Image]' => 'Testing',
            'packpersonnalise[id_programme]' => 'Testing',
        ]);

        self::assertResponseRedirects('/packpersonnalise/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Packpersonnalise();
        $fixture->setNom_packperso('My Title');
        $fixture->setType_pack('My Title');
        $fixture->setDescription_pack('My Title');
        $fixture->setPrix('My Title');
        $fixture->setDate('My Title');
        $fixture->setImage('My Title');
        $fixture->setId_programme('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Packpersonnalise');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Packpersonnalise();
        $fixture->setNom_packperso('My Title');
        $fixture->setType_pack('My Title');
        $fixture->setDescription_pack('My Title');
        $fixture->setPrix('My Title');
        $fixture->setDate('My Title');
        $fixture->setImage('My Title');
        $fixture->setId_programme('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'packpersonnalise[Nom_packperso]' => 'Something New',
            'packpersonnalise[type_pack]' => 'Something New',
            'packpersonnalise[Description_pack]' => 'Something New',
            'packpersonnalise[Prix]' => 'Something New',
            'packpersonnalise[Date]' => 'Something New',
            'packpersonnalise[Image]' => 'Something New',
            'packpersonnalise[id_programme]' => 'Something New',
        ]);

        self::assertResponseRedirects('/packpersonnalise/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getNom_packperso());
        self::assertSame('Something New', $fixture[0]->getType_pack());
        self::assertSame('Something New', $fixture[0]->getDescription_pack());
        self::assertSame('Something New', $fixture[0]->getPrix());
        self::assertSame('Something New', $fixture[0]->getDate());
        self::assertSame('Something New', $fixture[0]->getImage());
        self::assertSame('Something New', $fixture[0]->getId_programme());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Packpersonnalise();
        $fixture->setNom_packperso('My Title');
        $fixture->setType_pack('My Title');
        $fixture->setDescription_pack('My Title');
        $fixture->setPrix('My Title');
        $fixture->setDate('My Title');
        $fixture->setImage('My Title');
        $fixture->setId_programme('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/packpersonnalise/');
    }
}
