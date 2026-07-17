"use client";
import styles from "./Tags.module.scss";
import { useEffect, useState } from "react";

interface Category {
  id: number;
  name: string;
}

export const Tags = () => {
  const [categories, setCategories] = useState<Category[]>([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState<string | null>(null);

  useEffect(() => {
    const fetchCategories = async () => {
      try {
        const response = await fetch("/api/project-categories");

        if (!response.ok) {
          throw new Error(`Ошибка: ${response.status}`);
        }

        const result = await response.json();

        setCategories(result.data || []);
        setLoading(false);
      } catch (err) {
        setError(err instanceof Error ? err.message : "Ошибка загрузки");
        setLoading(false);
      }
    };

    fetchCategories();
  }, []);

  if (loading) {
    return <div className={styles.tags}>Загрузка...</div>;
  }

  if (error) {
    return <div className={styles.tags}>Ошибка: {error}</div>;
  }

  return (
    <div className={styles.tags}>
      {categories.map((category) => (
        <div className={styles.tag} key={category.id}>
          {category.name}
        </div>
      ))}
    </div>
  );
};
