import styles from "./SkeletonCard.module.scss";

export const SkeletonCard = () => {
  return (
    <div className={styles.skeleton}>
      <div className={styles.image} />
      <div className={styles.content}>
        <div className={styles.title} />
        <div className={styles.subtitle} />
      </div>
    </div>
  );
};
