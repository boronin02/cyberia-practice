"use client";

import styles from "./Card.module.scss";
import { isEven } from "@/shared/lib/isEven";
import { Project } from "@/entities/projects/model/ProjectsContext";

interface CardProps {
  side: "left" | "right";
  projects: Project[];
  loading: boolean;
  style?: "home" | "project";
}

export const Card = ({ side = "left", projects, loading, style = "home" }: CardProps) => {
  const columnClass = side === "left" ? styles.columnLeft : styles.columnRight;
  const marginClass = side === "right" && style === "home" ? styles.marginTop : "";
  const filterCondition = side === "left" ? isEven : (i: number) => !isEven(i);

  if (loading) {
    return <div className={`${columnClass} ${marginClass}`}>Загрузка...</div>;
  }

  return (
    <div className={`${columnClass} ${marginClass}`}>
      {projects.map(
        (card, i) =>
          filterCondition(i) && (
            <div key={card.id} className={styles.card}>
              <div
                className={styles.cardTop}
                style={{ backgroundImage: `url(${card.image.original_url})` }}
              />
              <div className={styles.cardBottom}>
                <div className={styles.cardBottomTitle}>{card.title}</div>
                <div className={styles.cardBottomSubtitle}>{card.description}</div>
              </div>
            </div>
          ),
      )}
    </div>
  );
};
