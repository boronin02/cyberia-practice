"use client";

import { Card } from "../index";
import styles from "./Cards.module.scss";
import { useEffect, useState } from "react";

interface Project {
  id: number;
  title: string;
  description: string;
  image: {
    original_url: string;
    preview_url: string;
  };
  is_big: boolean;
  is_case: boolean;
}

export const Cards = () => {
  const [projects, setProjects] = useState<Project[]>([]);
  const [loading, setLoading] = useState(true);
  const [page, setPage] = useState(1);
  const [lastPage, setLastPage] = useState(1);
  const [loadingMore, setLoadingMore] = useState(false);

  const fetchProjects = async (pageNum: number, append: boolean = false) => {
    try {
      if (append) {
        setLoadingMore(true);
      } else {
        setLoading(true);
      }

      const response = await fetch(`/api/projects?page=${pageNum}`);

      if (!response.ok) {
        throw new Error(`Ошибка: ${response.status}`);
      }

      const result = await response.json();
      const items = result.data.items || [];
      const pagination = result.data.pagination;

      if (append) {
        setProjects((prev) => [...prev, ...items]);
      } else {
        setProjects(items);
      }

      setLastPage(pagination.last_page);
      setPage(pageNum);
    } catch (err) {
      console.error("Ошибка загрузки проектов:", err);
    } finally {
      setLoading(false);
      setLoadingMore(false);
    }
  };

  useEffect(() => {
    // eslint-disable-next-line react-hooks/set-state-in-effect
    fetchProjects(1, false);
  }, []);

  const loadMore = () => {
    if (page < lastPage) {
      fetchProjects(page + 1, true);
    }
  };

  return (
    <>
      <div className={styles.wrapper}>
        <Card side="left" projects={projects} loading={loading} />
        <Card side="right" projects={projects} loading={loading} />
      </div>

      {page < lastPage && (
        <button className={styles.button} onClick={loadMore} disabled={loadingMore}>
          {loadingMore ? "Загрузка..." : "Загрузить еще"}
        </button>
      )}
    </>
  );
};
