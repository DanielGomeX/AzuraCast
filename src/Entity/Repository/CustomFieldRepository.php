<?php
namespace App\Entity\Repository;

use App\Entity;
use App\Doctrine\Repository;

class CustomFieldRepository extends Repository
{
    /**
     * @return Entity\CustomField[]
     */
    public function getAutoAssignableFields(): array
    {
        $fields = [];

        foreach ($this->repository->findAll() as $field) {
            /** @var Entity\CustomField $field */
            if (!$field->hasAutoAssign()) {
                continue;
            }

            $fields[$field->getAutoAssign()] = $field;
        }

        return $fields;
    }

    /**
     * Retrieve a key-value representation of all custom metadata for the specified media.
     *
     * @param Entity\StationMedia $media
     *
     * @return array
     */
    public function getCustomFields(Entity\StationMedia $media): array
    {
        $metadata_raw = $this->em->createQuery(/** @lang DQL */ 'SELECT cf.short_name, e.value 
            FROM App\Entity\StationMediaCustomField e JOIN e.field cf
            WHERE e.media_id = :media_id')
            ->setParameter('media_id', $media->getId())
            ->getArrayResult();

        $result = [];
        foreach ($metadata_raw as $row) {
            $result[$row['short_name']] = $row['value'];
        }

        return $result;
    }

    /**
     * Set the custom metadata for a specified station based on a provided key-value array.
     *
     * @param Entity\StationMedia $media
     * @param array $custom_fields
     */
    public function setCustomFields(Entity\StationMedia $media, array $custom_fields): void
    {
        $this->em->createQuery(/** @lang DQL */ 'DELETE FROM App\Entity\StationMediaCustomField e WHERE e.media_id = :media_id')
            ->setParameter('media_id', $media->getId())
            ->execute();

        foreach ($custom_fields as $field_id => $field_value) {
            $field = is_numeric($field_id)
                ? $this->em->find(Entity\CustomField::class, $field_id)
                : $this->em->getRepository(Entity\CustomField::class)->findOneBy(['short_name' => $field_id]);

            if ($field instanceof Entity\CustomField) {
                $record = new Entity\StationMediaCustomField($media, $field);
                $record->setValue($field_value);
                $this->em->persist($record);
            }
        }

        $this->em->flush();
    }
}