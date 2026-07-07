"use client";

import styles from "./LoadButton.module.scss";
import { useProjectsContext } from "@/entities/projects/model/ProjectsContext";

export const LoadButton = () => {
  const { hasNextPage, fetchNextPage, isFetchingNextPage } = useProjectsContext();

  if (!hasNextPage) return null;

  return (
    <button className={styles.button} onClick={() => fetchNextPage()} disabled={isFetchingNextPage}>
      {isFetchingNextPage ? "Загрузка..." : "Загрузить еще"}
    </button>
  );
};
