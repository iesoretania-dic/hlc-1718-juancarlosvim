<?php declare(strict_types = 1);

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180315162651 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE usuario (id INT AUTO_INCREMENT NOT NULL, nombre_usuario VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, nombre VARCHAR(255) NOT NULL, apellidos VARCHAR(255) NOT NULL, fecha_nacimiento DATE DEFAULT NULL, correo VARCHAR(255) NOT NULL, administrador TINYINT(1) NOT NULL, usuario_vip TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cancion (id INT AUTO_INCREMENT NOT NULL, artista VARCHAR(255) NOT NULL, titulo VARCHAR(255) NOT NULL, duracion VARCHAR(255) NOT NULL, fecha_cancion DATE NOT NULL, genero VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cancion_usuario (cancion_id INT NOT NULL, usuario_id INT NOT NULL, INDEX IDX_9240090B9B1D840F (cancion_id), INDEX IDX_9240090BDB38439E (usuario_id), PRIMARY KEY(cancion_id, usuario_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lista_musica (id INT AUTO_INCREMENT NOT NULL, propietario_id INT NOT NULL, nombre VARCHAR(255) NOT NULL, visible TINYINT(1) NOT NULL, INDEX IDX_CB483F2E53C8D32C (propietario_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cancion_usuario ADD CONSTRAINT FK_9240090B9B1D840F FOREIGN KEY (cancion_id) REFERENCES cancion (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cancion_usuario ADD CONSTRAINT FK_9240090BDB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE lista_musica ADD CONSTRAINT FK_CB483F2E53C8D32C FOREIGN KEY (propietario_id) REFERENCES usuario (id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cancion_usuario DROP FOREIGN KEY FK_9240090BDB38439E');
        $this->addSql('ALTER TABLE lista_musica DROP FOREIGN KEY FK_CB483F2E53C8D32C');
        $this->addSql('ALTER TABLE cancion_usuario DROP FOREIGN KEY FK_9240090B9B1D840F');
        $this->addSql('DROP TABLE usuario');
        $this->addSql('DROP TABLE cancion');
        $this->addSql('DROP TABLE cancion_usuario');
        $this->addSql('DROP TABLE lista_musica');
    }
}
